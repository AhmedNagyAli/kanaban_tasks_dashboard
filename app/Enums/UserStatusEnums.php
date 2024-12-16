<?php

namespace App\Enums;
use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;
enum UserStatusEnums: string
{
    use IsKanbanStatus;

    case Active = '1';
    case NotActive = '0';
}
