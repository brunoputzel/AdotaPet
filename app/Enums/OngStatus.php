<?php

namespace App\Enums;

enum OngStatus: string
{
    case Pendente = 'pendente';
    case Aprovada = 'aprovada';
    case Recusada = 'recusada';
}
