<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IsAdministrator;
use App\Http\Middleware\IsRecorder;
use App\Http\Middleware\IsExporter;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsGuest;
use App\Http\Middleware\IsPassStrongMod;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdministrator' => IsAdministrator::class,
            'isRecorder' => IsRecorder::class,
            'isExporter' => IsExporter::class,
            'isUser' => IsUser::class,
            'isGuest' => IsGuest::class,
            'isPassStrongMod' => IsPassStrongMod::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
