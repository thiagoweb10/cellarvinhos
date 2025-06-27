<?php

namespace App\Services;

use auth;
use Carbon\Carbon;
use App\DTOs\LoginUserDTO;
use App\Exceptions\Auth\InvalidCredentialsException;

class LoginService
{
    public function attemptLogin(LoginUserDTO $dto): ?array
    {
        $credentials = [
            'email' => $dto->email,
            'password' => $dto->password
        ];

        if (!auth()->attempt($credentials)){
            throw new InvalidCredentialsException();
        }

        $nameToken = 'crm-app';
        $token = auth()->user()->createToken($nameToken, [], Carbon::now()->addHours(2));

        return [
            'token'         => $token->plainTextToken,
            'expired_at'    => $token->accessToken->expired_at,
            'user'          => auth()->user()
        ];
    }

    public function logout($user): void
    {
        $this->logoutUserAction->execute($user);
    }
}