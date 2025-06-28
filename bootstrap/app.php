<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Prepend CORS to the global middleware stack (required for handling cross-origin requests)

        // Optional: add middleware aliases for Sanctum (if used)
        $middleware->alias([
            'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
            'ability'  => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
        ]);

        // Web-specific adjustments (CSRF exceptions, etc.)
        $middleware->web(append: [])
                   ->validateCsrfTokens(except: ['api/*']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
// This file is part of the Laravel framework and is used to bootstrap the application.
// It configures the application, sets up routing, middleware, and exception handling.
