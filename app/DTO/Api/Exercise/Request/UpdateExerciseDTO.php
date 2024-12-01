<?php

namespace App\DTO\Api\Exercise\Request;

use App\Models\Enums\ExerciseType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UpdateExerciseDTO extends Data
{
    public function __construct(
        public string $condition,
        public ?string $type = ExerciseType::MANUAL->value,
        public ?array $answers = [],
        public ?int $points = 1,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'condition'      => [
                'required',
            ],
        ];
    }
}
