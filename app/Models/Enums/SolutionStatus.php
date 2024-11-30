<?php

namespace App\Models\Enums;

enum SolutionStatus: string
{
    case NOT_VERIFIED = 'not_verified';
    case IN_PROCESS = 'in_process';
    case COMPLETED = 'completed';
}
