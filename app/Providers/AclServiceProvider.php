<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laminas\Permissions\Acl\Acl;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Acl::class, function ($app) {
            return new Acl();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(Acl $acl): void
    {
        $this->mergeConfigFrom(config_path('acl.php'), 'acl');

        $this->setupAcl($acl);
    }

    protected function setupAcl(Acl $acl)
    {
        foreach (config('acl.roles') as $roleName => $roleConfig) {
            $acl->addRole($roleName, $roleConfig['inheritsFrom'] ?? null);

            foreach ($roleConfig['resources'] as $resourceName => $resourcePrivileges) {
                if (!is_array($resourcePrivileges)) {
                    $resourceName = $resourcePrivileges;
                    $resourcePrivileges = null;
                }

                if (!$acl->hasResource($resourceName)) {
                    $acl->addResource($resourceName);
                }

                $acl->allow($roleName, $resourceName, $resourcePrivileges);
            }
        }
    }
}
