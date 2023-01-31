<?php

namespace App\Providers;

use App\Models\ExchangeStudent;
use App\Models\Semester;
use App\Models\TandemUser;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
     protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        Route::bind('exchangeStudent', function ($value) {
            return ExchangeStudent::findOrFail(User::decodeHashId($value));
        });

        Route::bind('student', function ($hash) {
            return ExchangeStudent::with(['person.user', 'user', 'arrival.transportation'])
                ->whereHas('user', function (Builder $query) use ($hash) {
                    $query->where('hash', $hash);
                })
                ->firstOrFail();
        });

        Route::bind('semester', function ($value) {
            return Semester::where('semester', $value)->firstOrFail();
        });

        Route::bind('tandemUser', function (string $value) {
            return TandemUser::findOrFail(TandemUser::decodeHashId($value));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
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
