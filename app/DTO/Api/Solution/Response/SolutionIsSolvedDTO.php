<?php

namespace App\DTO\Api\Solution\Response;

use App\Models\Program;
use App\Models\Solution;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class SolutionIsSolvedDTO extends Data
{
    public function __construct(
        public bool $isSolved,
        public Solution $solution
    ){
    }

    public static function fromModel(Solution $solution): self
    {
        return new self(
            $solution->isSolved(),
            $solution,
        );
    }
}
