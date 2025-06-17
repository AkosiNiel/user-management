<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
<<<<<<< HEAD
use App\Http\Middleware\CheckSuperAdmin;
=======
>>>>>>> 973fba8 (changes)

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
        $middleware->alias([
            'check.superadmin' => CheckSuperAdmin::class,
        ]);
=======
        //
>>>>>>> 973fba8 (changes)
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
