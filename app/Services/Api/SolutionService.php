<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Solution\Request\ProgramWithMarksShowDTO;
use App\Models\Lesson;
use App\Models\Program;
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
}
