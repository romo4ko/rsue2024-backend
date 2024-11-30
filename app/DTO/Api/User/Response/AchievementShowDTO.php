<?php

namespace App\DTO\Api\User\Response;

use App\Models\Achievement;
use App\Models\Program;
use Spatie\LaravelData\Data;

class AchievementShowDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $image,
    ){
    }

    public static function fromModel(Achievement $achievement): self
    {
        return new self(
            $achievement->id,
            $achievement->name,
            env('STORAGE_PATH') . $achievement->image,
        );
    }
}
