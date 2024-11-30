<?php

namespace App\DTO\Api\Solution\Response;

use App\Models\Program;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;

class ExerciseWithMarkShowDTO extends Data
{
    public function __construct(
        public string $id,
        public ?string $condition,
        public ?int $points,
        public ?int $mark,
    ){
    }

    public static function fromModel($solution): self
    {
        return new self(
            $solution->id,
            $solution->condition,
            $solution->points,
            $solution->mark,
        );
    }
}
