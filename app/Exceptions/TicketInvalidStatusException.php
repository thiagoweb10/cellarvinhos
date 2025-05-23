<?php

namespace App\Exceptions;

use Exception;

class TicketInvalidStatusException extends Exception
{
    public function __construct(string $status)
    {
        parent::__construct("Status inválido: {$status}.");
    }
}
