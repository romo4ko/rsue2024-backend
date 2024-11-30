<?php

namespace App\DTO\Api\Solution\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class SolutionVerifyDTO extends Data
{
    public function __construct(
        public int $mark,
        public string $comment,
    ){
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'comment'      => [
                'required',
            ],
            'mark' => [
                'required',
            ]
        ];
    }
}
