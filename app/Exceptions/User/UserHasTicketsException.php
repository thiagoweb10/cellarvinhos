<?php

namespace App\Exceptions\User;

use Exception;

class UserHasTicketsException extends Exception
{
    public function __construct()
    {
        parent::__construct('O usuário não pode ser excluído porque possui tickets vinculados.');
    }
}
