<?php

declare(strict_types=1);

namespace App\DTO\Api\Auth\Request;

use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\LaravelData\Data;

class UserAuthDTO extends Data
{
    public function __construct(
        public string $login,
        public string $password,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'login'      => [
                'required',
                'max:255',
            ],
            'password'   => [
                'required',
                'max:255',
                'min:8',
            ],
        ];
    }
}
