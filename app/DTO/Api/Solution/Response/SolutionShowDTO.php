<?php

namespace App\DTO\Api\Solution\Response;

use App\DTO\Api\Program\Response\ProgramShowDTO;
use App\Models\Program;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class SolutionShowDTO extends Data
{
    public function __construct(
        public ProgramShowDTO $program,
        public Collection $exercises,
    ){
    }

    public static function fromModel(Program $program, Collection $exercises): self
    {
        return new self(
            ProgramShowDTO::fromModel($program),
            $exercises->map(
                fn($mark) => ExerciseWithMarkShowDTO::fromModel($mark)
            )
        );
    }
}
