<?php

declare(strict_types=1);

namespace App\DTO\Api\Auth\Request;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\LaravelData\Data;

class UserRegisterDTO extends Data
{
    public function __construct(
        public string $name,
        public string $surname,
        public ?string $email,
        public ?string $parentId,
        public string $password,
        public string $patronymic,
        public string $login,
        public string $role,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'surname' => [
                'required',
                'max:255',
            ],
            'email'      => [
                'max:255',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password'   => [
                'required',
                'max:255',
                'min:8',
            ],
            'patronymic' => [
                'required',
                'max:255',
            ],
            'login' => [
                'required',
                'max:255',
                Rule::unique('users', 'login')
            ],
            'role' => [
                'required',
                Rule::exists('roles', 'name'),
            ],
            'parentId' => [
                Rule::exists('users', 'id'),
            ],
        ];
    }
}
