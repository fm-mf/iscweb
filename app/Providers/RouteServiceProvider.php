<?php

namespace App\Providers;

use App\Models\ExchangeStudent;
use App\Models\Semester;
use App\Models\TandemUser;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        Route::bind('exchangeStudent', function ($value) {
            return ExchangeStudent::findOrFail(User::decodeHashId($value));
        });

        Route::bind('semester', function ($value) {
            return Semester::where('semester', $value)->firstOrFail();
        });

        Route::bind('tandemUser', function (string $value) {
            return TandemUser::findOrFail(TandemUser::decodeHashId($value));
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapPartakRoutes();

        $this->mapBuddyprogramRoutes();

        $this->mapAuthRoutes();

        $this->mapSafRoutes();

        $this->mapPrivacyRoutes();

        $this->mapTandemRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace . '\Api')
            ->group(base_path('routes/api.php'));
    }

    /**
     *
     */
    protected function mapPartakRoutes()
    {
        Route::prefix('partak')
            ->middleware(['web','checkpartak', 'auth', 'printer'])
            ->namespace($this->namespace . '\Partak')
            ->name('partak.')
            ->group(base_path('routes/partak.php'));
    }

    protected function mapBuddyprogramRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/buddyprogram.php');
        });
    }

    protected  function mapAuthRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace . '\Auth',
            'prefix' => 'user'
        ], function ($router) {
            require base_path('routes/auth.php');
        });
    }

    protected  function mapSafRoutes()
    {
        Route::group([
                'namespace' => $this->namespace . '\Saf',
                'prefix' => 'scvutdosveta'
        ], function ($router) {
            require base_path('routes/saf.php');
        });
    }

    protected function mapPrivacyRoutes()
    {
        Route::group([
                'namespace' => $this->namespace . '\Privacy',
                'middleware' => 'web',
                'prefix' => 'privacy'
        ], function ($router) {
            require  base_path('routes/privacy.php');
        });
    }

    protected function mapTandemRoutes()
    {
        Route::middleware('web')
            ->name('tandem.')
            ->prefix('tandem')
            ->namespace("{$this->namespace}\\Tandem")
            ->group(base_path('routes/tandem.php'));
    }
}
