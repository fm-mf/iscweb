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
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Trip::class => TripPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Acl $acl)
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
    }
}
