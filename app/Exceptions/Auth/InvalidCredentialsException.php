<?php

namespace App\Exceptions\Auth;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Credenciais inválidas. Verifique seu e-mail e senha.');
    }

    public function render()
    {
        return response()->json([
            'status' => 'error',
            'error' => 'Credenciais inválidas',
            'message' => 'Verifique seu e-mail e senha.'
    ], 401);
    }
}
