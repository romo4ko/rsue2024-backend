<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreExerciseDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\DTO\Api\Program\Response\ProgramShowDTO;
use App\Models\Enums\Roles;
use App\Models\Exercise;
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

    public function storeExercises(Program $program, int $lessonId, ProgramStoreExerciseDTO $programStoreExerciseDTO): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::Teacher->value) {
            return response()->json(['message' => 'Пользователь не может создать задание для урока так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program->id)->first();

        if ($lesson) {
            $exercise = Exercise::query()->create([
                'condition' => $programStoreExerciseDTO->condition,
                'answers' => $programStoreExerciseDTO->answers,
                'points' => $programStoreExerciseDTO->points,
                'lesson_id' => $lesson->id,
            ]);

            return $exercise->toArray();
        }

        return response()->json(['message' => 'Не найден урок'], 403);
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
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::Teacher->value) {
            return response()->json(['message' => 'Пользователь не может удалить урок так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program->id)->first();

        if ($lesson) {
            $lesson->delete();

            return response()->noContent();
        }

        return response()->json(['message' => 'задание не найдено'], 404);
    }

    public function removeExercises(Program $program, int $lessonId, int $exerciseId): JsonResponse|Response
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::Teacher->value) {
            return response()->json(['message' => 'Пользователь не может удалить задание так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program->id)->first();
        $exercise = Exercise::query()->where('id', $exerciseId)->where('lesson_id', $lesson->id)->first();

        if ($exercise) {
            $exercise->delete();

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
