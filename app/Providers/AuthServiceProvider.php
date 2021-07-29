<?php

namespace App\Providers;

use App\Models\Trip;
use App\Policies\TripPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Zend\Permissions\Acl\Acl as Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

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
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        $this->setupAcl();

        $acl = $this->app->make('acl');
        $gate->define('acl', function($user, $resource) use($acl) {
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

    public function register()
    {
        $this->app->singleton('acl', function ($app) {
            return new \Zend\Permissions\Acl\Acl();
        });
    }

    private function setupAcl()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/acl.php', 'acl'
        );

        $acl = $this->app->make('acl');
        $roles = config('acl.roles');
        foreach ($roles as $roleName => $role) {
            if (key_exists('inheritsFrom', $role)) {
                $inheritsFrom = $role['inheritsFrom'];
            } else {
                $inheritsFrom = [];
            }

            $acl->addRole(new Role($roleName), $inheritsFrom);

            $resources = $role['resources'];
            foreach ($resources as $resourceName => $resource) {
                if (is_array($resource)) {
                    if (!$acl->hasResource($resourceName)) {
                        $acl->addResource($resourceName);
                    }

                    $acl->allow($roleName, $resourceName, $resource);

                } else {
                    if (!$acl->hasResource($resource)) {
                        $acl->addResource($resource);
                    }
                    $acl->allow($roleName, $resource);
                }

            }
        }
    }
}
