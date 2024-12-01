<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Exercise\Request\UpdateExerciseDTO;
use App\DTO\Api\Lesson\Request\UpdateLessonDTO;
use App\DTO\Api\Lesson\Response\LessonForStudentShowDTO;
use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreExerciseDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\DTO\Api\Program\Response\ProgramShowDTO;
use App\DTO\Api\Solution\Request\LessonWithMarksShowDTO;
use App\DTO\Api\Solution\Request\SolutionSolveDTO;
use App\DTO\Api\Solution\Request\SolutionVerifyDTO;
use App\DTO\Api\Solution\Response\SolutionIsSolvedDTO;
use App\Http\Controllers\Api\TelegramController;
use App\Models\Enums\ExerciseType;
use App\Models\Enums\Roles;
use App\Models\Exercise;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramService
{
    public function signUp(Program $program): array|JsonResponse
    {
        $student = auth()->user();

        if ($student?->roles->pluck('name')[0] === Roles::STUDENT->value) {

            if ($student?->programs()->where('program_id', $program->id)->get()->count() === 0) {
                $program->users()->attach($student);

                return ProgramShowDTO::from($program)->toArray();
            }

            return response()->json(['message' => 'Ученик уже состит на данном курсе'], 403);
        }

        return response()->json(['message' => 'Пользователь не может быть записан на курс так как он не студент'], 403);
    }

    public function show(Program $program): array
    {
        return ProgramShowDTO::from($program)->toArray();
    }

    public function lesson(Lesson $lesson): array
    {
        $user = auth()->user();
        if ($user?->roles->pluck('name')[0] === Roles::STUDENT->value) {
            $lesson = Lesson::query()->where('id', $lesson->id)->with(['exercises.solutions' => function($query) {
                $query->where('solutions.student_id', auth()->id());
            }])->first();

            return LessonForStudentShowDTO::fromModel($lesson)->toArray();
        }
        else {
            return Lesson::query()->where('id', $lesson->id)->with('exercises')->first()->toArray();
        }
    }

    public function storeExercises(Program $program, int $lessonId, ProgramStoreExerciseDTO $programStoreExerciseDTO): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может создать задание для урока так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->first();

        if ($lesson) {
            $exercise = Exercise::query()->create([
                'condition' => $programStoreExerciseDTO->condition,
                'answers' => $programStoreExerciseDTO->answers,
                'points' => $programStoreExerciseDTO->points,
                'lesson_id' => $lesson?->id,
            ]);

            return $exercise->toArray();
        }

        return response()->json(['message' => 'Не найден урок'], 403);
    }

    public function storeLesson(Program $program, ProgramStoreLessonDTO $programStoreLessonDTO): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может создать урок так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->create(
            [
                'name' => $programStoreLessonDTO->name,
                'theory' => $programStoreLessonDTO->theory,
                'program_id' => $program?->id,
            ]
        );

        return $lesson->toArray();
    }

    public function updateLesson(Program $program, int $lessonId, UpdateLessonDTO $updateLessonDTO): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может изменить урок так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->firstOrFail();

        $lesson->update(
            [
                'name' => $updateLessonDTO->name,
                'theory' => $updateLessonDTO->theory,
                'points' => $updateLessonDTO->points,
            ]
        );

        return $lesson->toArray();
    }

    public function updateExercise(Program $program, int $lessonId, int $exerciseId, UpdateExerciseDTO $updateExerciseDTO): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может изменить задание так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->first();
        $exercise = Exercise::query()->where('id', $exerciseId)->where('lesson_id', $lesson?->id)->firstOrFail();

        $exercise->update(
            [
                'type' => $updateExerciseDTO->type ? ExerciseType::tryFrom($updateExerciseDTO->type) : ExerciseType::TEST->value,
                'condition' => $updateExerciseDTO->condition,
                'answers' => $updateExerciseDTO->answers,
                'points' => $updateExerciseDTO->points,
            ]
        );

        return $exercise->toArray();
    }

    public function removeLesson(Program $program, int $lessonId):  JsonResponse|Response
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может удалить урок так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->first();

        if ($lesson) {
            $lesson->delete();

            return response()->noContent();
        }

        return response()->json(['message' => 'задание не найдено'], 404);
    }

    public function removeExercises(Program $program, int $lessonId, int $exerciseId): JsonResponse|Response
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может удалить задание так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->first();
        $exercise = Exercise::query()->where('id', $exerciseId)->where('lesson_id', $lesson?->id)->first();

        if ($exercise) {
            $exercise->delete();

            return response()->noContent();
        }

        return response()->json(['message' => 'задание не найдено'], 404);
    }

    public function solutionsSolve(Program $program, int $lessonId, int $exerciseId, SolutionSolveDTO $solutionSolveDTO): JsonResponse|Response|array
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::STUDENT->value) {
            return response()->json(['message' => 'Пользователь не может решить здание так как он не ученик'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->first();
        $exercise = Exercise::query()->where('id', $exerciseId)->where('lesson_id', $lesson?->id)->first();

        if ($exercise && $program->users()->exists()) {
            $solutionSolve = Solution::query()->create([
                'answer' => $solutionSolveDTO->answer,
                'student_id' => auth()->id(),
                'teacher_id' => $program->users()->first()->id,
                'exercise_id' => $exercise?->id,
            ]);

            return $solutionSolve->toArray();
        }

        return response()->json(['message' => 'задание не найдено'], 404);
    }

    public function solutionsVerify(Program $program, int $lessonId, int $exerciseId, $solutionId, SolutionVerifyDTO $solutionVerifyDTO): JsonResponse|Response|array
    {
        $user = auth()->user();
        if ($user?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может проверить задание так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->firstOrFail();
        $exercise = Exercise::query()->where('id', $exerciseId)->where('lesson_id', $lesson?->id)->firstOrFail();

        $solution = Solution::query()
            ->where('exercise_id', $exercise?->id)
            ->where('id', $solutionId)
            ->first();

        if ($solution) {
            $solution->comment = $solutionVerifyDTO->comment;
            if ($solutionVerifyDTO->mark !== null) {
                $solution->mark = $solutionVerifyDTO->mark;
            }
            $solution->teacher_id = $user->id;
            $solution->verified_at = now();

            $solution->save();

            $telegramController = new TelegramController();
            $telegramController->solutionVerified($solution);

            return $solution->toArray();
        }

        return response()->json(['message' => 'задание не найдено'], 404);
    }

    public function getListSolutions(Program $program, int $lessonId, int $exerciseId, Request $request): JsonResponse|Response|array
    {
        $user = auth()->user();
        if ($user?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может проверить задание так как он не учитель'], 403);
        }

        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->firstOrFail();
        $exercise = Exercise::query()->where('id', $exerciseId)->where('lesson_id', $lesson?->id)->firstOrFail();

        $solution = Solution::query()
            ->where('exercise_id', $exercise?->id)
            ->whereNotNull('answer')
            ->whereNull('mark');

        return $solution->get()->toArray();
    }

    public function isSolved(Program $program, int $lessonId, int $exerciseId): array|JsonResponse
    {
        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $program?->id)->first();
        $exercise = Exercise::query()->where('id', $exerciseId)->where('lesson_id', $lesson?->id)->first();
        $solution = Solution::query()
            ->where('student_id', auth()->id())
            ->where('teacher_id', $program->users()->first()->id)
            ->where('exercise_id', $exercise?->id)
            ->first();

        if ($solution) {
            return SolutionIsSolvedDTO::fromModel($solution)->toArray();
        }
        return response()->json(['message' => 'задание не найдено'], 404);
    }

    public function list(): array
    {
        $user = auth()->user();
        if ($user?->roles->pluck('name')[0] === Roles::STUDENT->value) {
            $program = Program::query()
                ->with('users')
                ->whereDoesntHave('users', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->get();
        } else if ($user?->roles->pluck('name')[0] === Roles::TEACHER->value) {
            $program = Program::query()
                ->with('users')
                ->whereHas('users', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->get();
        }

        return ProgramShowDTO::collect($program)->toArray();
    }

    public function getExercises(Program $program, int $lessonId): array
    {
        return Lesson::query()
            ->with('exercises')
            ->where('id', $lessonId)
            ->where('program_id', $program?->id)
            ->firstOrFail()
            ->toArray();
    }
}
