<?php

namespace App\Providers;

use App\Models\Trip;
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

        Gate::define('acl', function($user, $resource) use($acl) {
            $resource = explode('.', $resource);
            if (count($resource) == 2) {
                $action = $resource[1];
                $resource = $resource[0];
            } else {
                $action = null;
                $resource = $resource[0];
            }

            foreach ($user->roles as $role) {
                $isAllowed = $acl->isAllowed($role->title, $resource, $action);
                if ($isAllowed) {
                    return true;
                }
            }
            return false;
        });
    }
}
