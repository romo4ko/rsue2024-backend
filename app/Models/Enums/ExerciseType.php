<?php

namespace App\Models\Enums;

enum ExerciseType: string
{
    case TEST = 'test';
    case PRACTICE = 'practice';
    case MANUAL = 'manual';

    public static function getTranslations(): array
    {
        return [
            self::TEST->value => 'Тест',
            self::PRACTICE->value => 'Практическое задание',
            self::MANUAL->value => 'Развёрнутый ответ',
        ];
    }
}
