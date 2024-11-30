<?php

namespace App\DTO\Api\Program\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ProgramStoreLessonDTO extends Data
{
    public function __construct(
        public string $name,
        public string $theory
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
