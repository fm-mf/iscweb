<?php

namespace App\Providers;

use App\Models\Trip;
use App\Models\User;
use App\Policies\TripPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laminas\Permissions\Acl\Acl;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Trip::class => TripPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(Acl $acl): void
    {
        $this->registerPolicies();

        Gate::define('acl', function(User $user, string $resource) use ($acl): bool {
            try {
                [$resource, $action] = explode('.', $resource);
            } catch (\Throwable $e) {
                $action = null;
            }

            foreach ($user->roles as $role) {
                if ($acl->isAllowed($role->title, $resource, $action)) {
                    return true;
                }
            }

            return false;
        });

        $this->bootCvutAuthSocialiteProvider();
    }

    private function bootCvutAuthSocialiteProvider()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'cvut',
            function ($app) use ($socialite) {
                $config = $app['config']['services.cvut'];
                return $socialite->buildProvider(CvutAuthProvider::class, $config);
            }
        );
    }
}
