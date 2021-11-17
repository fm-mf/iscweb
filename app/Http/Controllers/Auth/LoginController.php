<?php

namespace App\Http\Controllers\Auth;

use App\Events\BuddyRegistered;
use App\Events\BuddyVerified;
use App\Helpers\Locale;
use App\Http\Controllers\Controller;
use App\Models\SocialAuthProvider;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as traitLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $availableAuthProviders = [
        'cvut',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['password'] = $this->encryptPassword($credentials);
        return $credentials;
    }

    private function encryptPassword($credentials)
    {
        return hash("sha512", $credentials['email'] . '@' . $credentials['password']);
    }

    public function logout(Request $request)
    {
        $tandemUser = auth('tandem')->user();
        $locale = session(Locale::SESSION_KEY);
        $localeTandem = session(Locale::SESSION_KEY_TANDEM);

        $return = $this->traitLogout($request);

        $tandemUser === null ?: auth('tandem')->login($tandemUser);
        $locale === null ?: session([Locale::SESSION_KEY => $locale]);
        $localeTandem === null ?: session([Locale::SESSION_KEY_TANDEM => $localeTandem]);

        return $return;
    }

    public function redirectToProvider(string $provider)
    {
        if (!in_array($provider, $this->availableAuthProviders)) {
            throw new NotFoundHttpException();
        }

        if (!config('services.' . $provider . '.client_id')
            || !config('services.' . $provider . '.client_secret')
            || !config('services.' . $provider . '.redirect')) {
            throw new NotFoundHttpException('Config not set properly');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        if (!in_array($provider, $this->availableAuthProviders)) {
            throw new NotFoundHttpException();
        }

        $user = $this->getUserFromSocialProvider($provider);

        auth()->login($user);

        return $user->wasRecentlyCreated
            ? redirect()->route('auth.profile.edit')
                ->with('social-auth', session('url.intended') ?? route('buddy-home'))
            : redirect()->intended(route('buddy-home'));
    }

    protected function getUserFromSocialProvider(string $provider): User
    {
        $socialiteUser = Socialite::driver($provider)->stateless()->user();

        $socialProvider = SocialAuthProvider::where([
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
        ])->first();

        if ($socialProvider) {
            return $socialProvider->user;
        }

        $user = User::firstOrCreate([
            'email' => $socialiteUser->getEmail(),
        ]);

        $user->person()->updateOrCreate([], [
            'first_name' => $socialiteUser->firstName,
            'last_name' => $socialiteUser->lastName,
        ]);

        $user->buddy()->updateOrCreate([], [
            'verification_email' => $socialiteUser->getEmail(),
            'agreement' => 1,
        ]);
        $user->buddy->setVerified();
        event(new BuddyRegistered($user->buddy));
        event(new BuddyVerified($user->buddy));

        $user->socialAuthProviders()->create([
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
        ]);

        return $user;
    }
}
