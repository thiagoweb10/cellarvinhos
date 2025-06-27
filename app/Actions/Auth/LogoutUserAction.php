<?php

namespace App\Actions\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

class LogoutUserAction
{
    public function execute(Authenticatable $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
