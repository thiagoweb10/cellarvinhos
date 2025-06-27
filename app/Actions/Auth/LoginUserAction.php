<?php

namespace App\Actions\Auth;

use App\DTOs\LoginUserDTO;
use App\Services\LoginService;

class LoginUserAction
{
    public function __construct(
        protected LoginService $authService
    ){}

    public function execute(LoginUserDTO $dto): ?array
    {
        return $this->authService->attemptLogin($dto);
    }
}