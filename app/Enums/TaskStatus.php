<?php

namespace App\Enums;
use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum TaskStatus: string
{
    use IsKanbanStatus;
    case Complete = 'complete';
    case Problem = 'problem';
    case Waiting = 'waiting';
    case ideas = 'ideas';

    case under_execution  ='under_execution';

}
