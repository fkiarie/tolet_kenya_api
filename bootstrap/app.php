<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    // Sanctum: Enable cookie-based API authentication (for SPAs if needed)
    //$middleware->statefulApi();

    // Optional: Add middleware aliases for checking token abilities
    $middleware->alias([
        'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
        'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
    ]);
    // You generally do NOT need to exclude 'api/*' from CSRF here
        // if your API routes are correctly in routes/api.php and are not
        // accidentally part of the 'web' middleware group.
        // If you still get 419 after removing statefulApi(), then uncomment this.
        /*
        $middleware->web(append: [
            // Add any middleware specific to web routes here
        ])->validateCsrfTokens(except: [
            'api/*',
        ]);
        */

        // If you have custom API middleware, you can define them here
        // $middleware->api(prepend: [
        //     // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // if using Sanctum SPA
        // ])
})

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
