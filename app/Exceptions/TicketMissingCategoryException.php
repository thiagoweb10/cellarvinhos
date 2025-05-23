<?php

namespace App\Exceptions;

use Exception;

class TicketMissingCategoryException extends Exception
{
    public function __construct()
    {
        parent::__construct('O ticket deve estar vinculado a uma categoria válida.');
    }
}
