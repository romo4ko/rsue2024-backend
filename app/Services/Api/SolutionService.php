<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\DTO\Api\Program\Response\ProgramShowDTO;
use App\Models\Enums\Roles;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SolutionService
{
    public function storeLesson(Program $program, ProgramStoreLessonDTO $programStoreLessonDTO): array|JsonResponse
    {

        if (auth()->user()?->roles->pluck('name')[0] !== Roles::Teacher->value) {
            return response()->json(['message' => 'Пользователь не может создать урок так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->create(
            [
                'name' => $programStoreLessonDTO->name,
                'theory' => $programStoreLessonDTO->theory,
                'program_id' => $program->id,
            ]
        );

        return $lesson->toArray();
    }

    public function removeLesson(Program $program, int $lessonId):  JsonResponse|Response
    {
        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program->id)->first();

        if ($lesson) {
            $lesson->delete();

            return response()->noContent();
        }

        return response()->json(['message' => 'задание не найдено'], 404);
    }

    public function list(Collection $programs): array
    {
        return $programs->map(
            fn(Program $program) => ProgramShowDTO::from($program)->toArray()
        )->toArray();
    }
}
