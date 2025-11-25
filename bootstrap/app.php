<?php

use App\Http\Middleware\isAdminMiddleware;
use App\Http\Middleware\isCustomerMiddleware;
use App\Http\Middleware\isRiderMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'is_admin' => isAdminMiddleware::class,
            'is_customer' => isCustomerMiddleware::class,
            'is_rider' => isRiderMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
