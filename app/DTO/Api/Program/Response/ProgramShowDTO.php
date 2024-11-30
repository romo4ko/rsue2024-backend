<?php

namespace App\DTO\Api\Program\Response;

use App\Models\Program;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class ProgramShowDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public ?string $image,
        public int $min_student_age,
        public int $max_student_age,
        public string $created_at,
        public string $updated_at,
    ){
    }

    public static function fromModel(Program $program): self
    {
        return new self(
            $program->id,
            $program->name,
            $program->description,
            $program->image,
            $program->min_student_age,
            $program->max_student_age,
            $program->created_at->toIso8601String(),
            $program->updated_at->toIso8601String(),
        );
    }
}
