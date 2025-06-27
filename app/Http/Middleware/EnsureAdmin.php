<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->role !== 'admin') {
            return response()->json([
                'error'=> 'true',
                'message' => 'Acesso negado. Apenas administradores podem acessar esta rota.'
            ], 403);
        }

        return $next($request);
    }
}
