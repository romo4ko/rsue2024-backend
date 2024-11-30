<?php

namespace App\DTO\Api\Program\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ProgramStoreExerciseDTO extends Data
{
    public function __construct(
        public string  $condition,
        public ?string $answers,
        public int     $points
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'condition' => [
                'required',
            ],
            'points' => [
                'required',
            ],
        ];
    }
}
