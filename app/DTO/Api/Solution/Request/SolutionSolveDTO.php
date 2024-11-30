<?php

namespace App\DTO\Api\Solution\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class SolutionSolveDTO extends Data
{
    public function __construct(
        public string $answer,
    ){
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'answer'      => [
                'required',
            ],
        ];
    }
}
