<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Solution\Request\ProgramWithMarksShowDTO;
use App\Models\Enums\Roles;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SolutionService
{
    public function list(int $userId, int $programId): array
    {
        $program = Program::query()->findOrFail($programId);

        $lessons = Lesson::query()
            ->select(['lessons.id', 'lessons.name', 'lessons.points'])
            ->join('exercises', 'lessons.id', 'exercises.lesson_id')
            ->join('solutions', 'exercises.id', '=', 'solutions.exercise_id')
            ->where('program_id', $programId)
            ->where('solutions.student_id', $userId)
            ->groupBy('lessons.id')
            ->groupBy('lessons.name')
            ->groupBy('lessons.points')
            ->get();

        $exercises = DB::query()
            ->select(['exercises.*', 'solutions.mark'])
            ->from('solutions')
            ->join('exercises', 'solutions.exercise_id', '=', 'exercises.id')
            ->join('lessons', 'exercises.lesson_id', '=', 'lessons.id')
            ->join('programs', 'lessons.program_id', '=', 'programs.id')
            ->where('solutions.student_id', $userId)
            ->where('programs.id', $programId)
            ->get();

        return ProgramWithMarksShowDTO::fromModel($program, $lessons, $exercises)->toArray();
    }

    public function childrensMarks(User $user): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::PARENT->value) {
            return response()->json(['message' => 'Пользователь не может получить список успеваемости так ка кон не родитель'], 403);
        }

        $childrens = User::with(['programs.lessons.exercises.solutions' => function($query) {
            $query->whereNotNull('solutions.mark');
        }])
            ->with(['programs.lessons' => function ($query) {
                $query->has('exercises');
            }])
            ->where('parent_id', $user->id)
            ->get();

        return $childrens->toArray();
    }
}
