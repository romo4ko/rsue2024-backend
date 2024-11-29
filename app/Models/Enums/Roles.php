<?php

namespace App\Models\Enums;

enum Roles: string
{
    case Admin = 'admin';
    case Teacher = 'teacher';
    case Student = 'student';
    case Parent = 'parent';
}
