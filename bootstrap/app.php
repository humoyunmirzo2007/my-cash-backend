<?php

use App\Http\Middleware\SetAccept;
use App\Http\Middlewares\SetLocaleFromRequest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SetLocaleFromRequest::class);
        $middleware->append(SetAccept::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
