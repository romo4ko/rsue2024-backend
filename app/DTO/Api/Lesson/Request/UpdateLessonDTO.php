<?php

namespace App\DTO\Api\Lesson\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UpdateLessonDTO extends Data
{
    public function __construct(
        public string $name,
        public string $theory,
        public ?int $points = 1,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'name'      => [
                'required',
            ],
            'theory'      => [
                'required',
            ],
        ];
    }
}
