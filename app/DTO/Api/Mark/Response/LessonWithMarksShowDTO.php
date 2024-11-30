<?php

namespace App\DTO\Api\Mark\Response;

use App\Models\Lesson;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class LessonWithMarksShowDTO extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public ?int $points,
        public Collection $exercises,
    ) {
    }

    public static function fromModel(Lesson $lesson, Collection $exercises): self
    {
        return new self(
            $lesson->id,
            $lesson->name,
            $lesson->points,
            $exercises->filter(
                fn($mark) => $mark->lesson_id === $lesson->id
            )->map(
                fn($mark) => ExerciseWithMarkShowDTO::fromModel($mark)
            )
        );
    }
}
