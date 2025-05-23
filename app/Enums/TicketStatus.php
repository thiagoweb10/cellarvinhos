<?php

namespace App\Enums;

enum TicketStatus: string
{
    case Aberto = 'Aberto';
    case EmProgresso = 'Em_Progresso';
    case Resolvido = 'Resolvido';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

