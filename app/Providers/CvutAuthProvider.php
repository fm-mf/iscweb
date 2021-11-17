<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use Ramsey\Uuid\Uuid;

class CvutAuthProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = [
        'cvut:umapi:read',
    ];

    protected $scopeSeparator = "\n";

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://auth.fit.cvut.cz/oauth/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://auth.fit.cvut.cz/oauth/token';
    }

    public function getAccessTokenResponse($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(),
            [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => $this->getTokenFields($code),
            ]);

        return json_decode($response->getBody(), true);
    }

    protected function getTokenFields($code)
    {
        $tokenFields = [
            'grant_type' => 'authorization_code',
            'scope' => $this->formatScopes($this->getScopes(), $this->scopeSeparator),
        ];

        return array_merge(parent::getTokenFields($code), $tokenFields);
    }

    protected function getUserByToken($token)
    {
        $parameters = ['query' => ['token' => $token]];
        $response = $this->getHttpClient()->get('https://auth.fit.cvut.cz/oauth/check_token', $parameters);

        return json_decode($response->getBody(), true);
    }

    public function user()
    {
        $user = parent::user();

        $extraInformation = $this->getExtraUserInformation($user->getNickname(), $user->token);

        $user->map([
            'name' => $extraInformation['fullName'],
            'email' => $this->findUniversityEmail($user, $extraInformation) ?? $extraInformation['preferredEmail'],
            'firstName' => $extraInformation['firstName'],
            'lastName' => $extraInformation['lastName'],
            'preferredEmail' => $extraInformation['preferredEmail'],
            'emails' => $extraInformation['emails'],
            'id' => Uuid::fromString(hash('md5', "{$extraInformation['kosPersonId']}"))->toString(),
        ]);

        return $user;
    }

    protected function mapUserToObject(array $data)
    {
        $user = new User();
        $user->setRaw($data);

        return $user->map([
            'nickname' => $data['user_name'],
        ]);
    }

    private function getExtraUserInformation(string $username, string $token)
    {
        $response = $this->getHttpClient()->get("https://kosapi.fit.cvut.cz/usermap/v1/people/{$username}", [
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Accept' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function findUniversityEmail(User $user, array $extraInformation): ?string
    {
        if ($this->isUniversityEmail($user->getNickname(), $extraInformation['preferredEmail'])) {
            return $extraInformation['preferredEmail'];
        }

        foreach ($extraInformation['emails'] as $email) {
            if ($this->isUniversityEmail($user->getNickname(), $email)) {
                return $email;
            }
        }

        return null;
    }

    protected function isUniversityEmail(string $nickname, string $email): bool
    {
        return strcmp($nickname, explode('@', $email)[0]) === 0;
    }
}
