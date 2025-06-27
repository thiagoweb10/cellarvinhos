<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * Lista de exceções que não devem ser reportadas.
     */
    protected $dontReport = [];

    /**
     * Campos que não devem ser exibidos em erros de validação.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Aqui você pode registrar callbacks para exceções.
     */
    public function register(): void
    {
        // Pode adicionar log ou sentry aqui se quiser.
    }

    /**
     * Intercepta exceções lançadas, ideal para personalizar mensagens.
     */
    protected function prepareException(Throwable $e)
    {
        // Captura exceções de autorização do Gate e troca a mensagem
        if ($e instanceof AuthorizationException) {
            return new AccessDeniedHttpException(
                'Acesso negado. Apenas administradores podem acessar esta rota.',
                $e
            );
        }

        return parent::prepareException($e);
    }

    /**
     * Garante que exceções tratadas acima sejam exibidas em JSON.
     */
    public function render($request, Throwable $exception)
    {
        if (
            $exception instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException &&
            $request->expectsJson()
        ) {
            return response()->json([
                'message' => 'Acesso negado. Apenas administradores podem acessar esta rota.'
            ], 403);
        }

        return parent::render($request, $exception);
    }
}