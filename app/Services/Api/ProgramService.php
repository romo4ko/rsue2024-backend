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

class ProgramService
{
    public function signUp(Program $program, ProgramSignUpDTO $programSignUpDTO): array|JsonResponse
    {
        $user = User::query()->find($programSignUpDTO->userId);

        if (auth()->id() === $user?->parent_id) {
            if ($user?->roles->pluck('name')[0] === Roles::Student->value) {
                $program->users()->attach($user);

                return ProgramShowDTO::from($program)->toArray();
            }

            return response()->json(['message' => 'Пользователь не может быть записан на курс так как он не студент'], 403);
        }

        return response()->json(['message' => 'Вы не являетесь родителм данного ребенка'], 403);
    }

    public function show(Program $program): array
    {
        return ProgramShowDTO::from($program)->toArray();
    }

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
