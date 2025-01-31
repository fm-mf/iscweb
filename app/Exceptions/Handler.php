<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            if ($request->is('partak') || $request->is('partak/*')) {
                return back()->with(['AlertMessage' => 'You are not authorised for this action']);
            } else {
                return response()->view('errors.unauthorized');
            }
        }
        if ($exception instanceof UserDoesntExist) {
            if ($request->is('partak') || $request->is('partak/*')) {
                return back()->with(['AlertMessage' => $exception->getMessage()]);
            }
        }
        if ($exception instanceof ModelNotFoundException) {
            if ($request->routeIs('partak.users.buddies.*')) {
                return redirect()->route('partak.users.buddies.index')->with([
                    'AlertMessage' => 'Buddy does not exist !!!',
                ]);
            }
        }
        return parent::render($request, $exception);
    }

    protected function unauthorized($request, AuthorizationException $exception)
    {
        return response()->view('errors.unauthorized');
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (!$request->routeIs('tandem.*')) {
            return parent::unauthenticated($request, $exception);
        }

        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route('tandem.login'));
    }

}
