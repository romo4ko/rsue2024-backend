<?php

namespace App\Models\Enums;

enum Roles: string
{
    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case STUDENT = 'student';
    case PARENT = 'parent';

    public static function values(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }

    public static function getTranslations(): array
    {
        return [
            self::ADMIN->value => 'Администратор',
            self::TEACHER->value => 'Учитель',
            self::STUDENT->value => 'Ученик',
            self::PARENT->value => 'Родитель',
        ];
    }
}
