<?php

namespace App\DTO\Api\Exercise\Response;

use App\DTO\Api\Lesson\Response\ExerciseShowDTO;
use App\DTO\Api\User\Response\UserShowDTO;
use App\Models\Enums\SolutionStatus;
use App\Models\Exercise;
use App\Models\Program;
use App\Models\Solution;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ExerciseForStudentShowDTO extends Data
{
    public function __construct(
        public int $id,
        public ?string $type,
        public string $condition,
        public ?int $points,
        public ?array $solution,
    ){
    }

    public static function fromModel(Exercise $exercise): self
    {
        $solution = $exercise->solutions->first();

        return new self(
            $exercise->id,
            $exercise->type,
            $exercise->condition,
            $exercise->points,
            $solution ? [
                'answer' => $solution->answer,
                'mark' => $solution->mark,
                'comment' => $solution->comment,
                'status' => $solution->status?->value,
            ] : null
        );
    }
}
