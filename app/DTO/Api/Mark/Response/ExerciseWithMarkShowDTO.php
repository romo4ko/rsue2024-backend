<?php

namespace App\DTO\Api\Mark\Response;

use Spatie\LaravelData\Data;

class ExerciseWithMarkShowDTO extends Data
{
    public function __construct(
        public string $id,
        public ?string $condition,
        public ?int $points,
        public ?int $mark,
    ) {
    }

    public static function fromModel($exercise): self
    {
        return new self(
            $exercise->id,
            $exercise->condition,
            $exercise->points,
            $exercise->mark,
        );
    }
}
