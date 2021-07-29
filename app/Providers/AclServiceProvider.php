<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Acl $acl)
    {
        $this->mergeConfigFrom(config_path('acl.php'), 'acl');

        $this->setupAcl($acl);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Acl::class, function ($app) {
            return new Acl();
        });
    }

    protected function setupAcl(Acl $acl)
    {
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
