<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IsAdministrator;
use App\Http\Middleware\IsGuest;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsRecorder;
use App\Http\Middleware\CheckAppMode;
use App\Http\Middleware\FtpSetter;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdministrator' => IsAdministrator::class,
            'isGuest' => IsGuest::class,
            'isUser' => IsUser::class,
            'isRecorder' => IsRecorder::class,
            'checkAppMode' => CheckAppMode::class,
            'ftp' => FtpSetter::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
