<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Limite padrao de requisicoes pra toda a API (60/min por
        // usuario autenticado, ou por IP se anonimo) -- ver
        // AppServiceProvider::configureRateLimiting(). Antes disso so
        // as rotas de auth tinham throttle, o resto da API (livros,
        // mensagens, favoritos etc.) nao tinha limite nenhum.
        $middleware->throttleApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
