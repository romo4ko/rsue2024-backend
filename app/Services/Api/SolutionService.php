<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\DTO\Api\Program\Response\ProgramShowDTO;
use App\DTO\Api\Solution\Response\ExerciseWithMarkShowDTO;
use App\DTO\Api\Solution\Response\SolutionShowDTO;
use App\Models\Enums\Roles;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SolutionService
{
    public function list(int $userId, int $programId): array
    {
        $program = Program::query()->findOrFail($programId);

        $marks = DB::query()
            ->select(['exercises.*', 'solutions.mark', 'solutions.answer'])
            ->from('solutions')
            ->join('exercises', 'solutions.exercise_id', '=', 'exercises.id')
            ->join('lessons', 'exercises.lesson_id', '=', 'lessons.id')
            ->join('programs', 'lessons.program_id', '=', 'programs.id')
            ->where('solutions.student_id', $userId)
            ->where('programs.id', $programId)
            ->get();


        return SolutionShowDTO::fromModel($program, $marks)->toArray();
    }
}
