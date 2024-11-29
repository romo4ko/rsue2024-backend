<?php

namespace App\DTO\Api\Program\Response;

use App\Models\Program;
use Spatie\LaravelData\Data;

class ProgramShowDTO extends Data
{
    public function __construct(
        public Program $program,
    ){
    }

    public static function fromModel(Program $program): self
    {
        return new self(
            $program,
        );
    }
}
