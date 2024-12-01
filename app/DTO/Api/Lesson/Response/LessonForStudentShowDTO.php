<?php

namespace App\DTO\Api\Lesson\Response;

use App\DTO\Api\Exercise\Response\ExerciseForStudentShowDTO;
use App\DTO\Api\User\Response\UserShowDTO;
use App\Models\Lesson;
use App\Models\Program;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class LessonForStudentShowDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $theory,
        public ?int $points,
        public Collection $exercises,
    ){
    }

    public static function fromModel(Lesson $lesson): self
    {
        return new self(
            $lesson->id,
            $lesson->name,
            $lesson->theory,
            $lesson->points,
            $lesson->exercises?->map(
                fn($exercise) => ExerciseForStudentShowDTO::fromModel($exercise)
            ),
        );
    }
}
