<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Program\Response\ProgramShowDTO;
use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

class ProgramService
{
    public function show(Program $program): array
    {
        return ProgramShowDTO::from($program)->toArray();
    }

    public function list(Collection $programs): array
    {
        return $programs->map(
            fn(Program $program) => ProgramShowDTO::from($program)->toArray()
        )->toArray();
    }
}
