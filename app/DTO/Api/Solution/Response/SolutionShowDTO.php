<?php

namespace App\DTO\Api\Solution\Response;

use App\Models\Program;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;

class SolutionShowDTO extends Data
{
    public function __construct(
        public Solution $solution,
        public Collection $exercises
    ){
    }

    public static function fromModel(Solution $solution, Collection $exercises): self
    {
        return new self(
            $solution,
            $exercises
        );
    }
}
