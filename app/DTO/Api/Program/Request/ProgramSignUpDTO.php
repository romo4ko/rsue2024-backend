<?php

namespace App\DTO\Api\Program\Request;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ProgramSignUpDTO extends Data
{
    public function __construct(
        public int $userId,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'userId'      => [
                'required',
                Rule::exists('users', 'id'),
            ],
        ];
    }
}
