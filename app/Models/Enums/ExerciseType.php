<?php

namespace App\Models\Enums;

enum ExerciseType: string
{
    case TEST = 'test';
    case PRACTICE = 'practice';
    case MANUAL = 'manual';
}
