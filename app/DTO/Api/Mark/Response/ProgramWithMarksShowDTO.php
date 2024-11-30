<?php

namespace App\DTO\Api\Mark\Response;

use App\DTO\Api\Program\Response\ProgramShowDTO;
use App\Models\Program;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ProgramWithMarksShowDTO extends Data
{
    public function __construct(
        public ProgramShowDTO $program,
        public Collection $lessons,
    ) {
    }

    public static function fromModel(Program $program, Collection $lessons, Collection $exercises): self
    {
        return new self(
            ProgramShowDTO::fromModel($program),
            $lessons->map(
                fn($lesson) => LessonWithMarksShowDTO::fromModel(
                    $lesson,
                    $exercises
                )
            )
        );
    }
}
