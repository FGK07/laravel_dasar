<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // registrasikan di sini bisa pakai alias ataupun append
        $middleware->alias([
            'contoh'=>\App\Http\Middleware\ContohMiddleware::class,
        ]);

        $middleware->appendToGroup(('fgk07'), [
            \App\Http\Middleware\ContohMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->reportable(function (Throwable $e){
             dump($e);
          // return false // pakai ini juga bisa
        })->stop();//bisa pakai stop

        $exceptions->dontReport([ValidationException::class]);
    })->create();
