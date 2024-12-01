<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\Exercise\Request\UpdateExerciseDTO;
use App\DTO\Api\Lesson\Request\UpdateLessonDTO;
use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreExerciseDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\DTO\Api\Solution\Request\SolutionSolveDTO;
use App\DTO\Api\Solution\Request\SolutionVerifyDTO;
use App\Models\Lesson;
use App\Models\Program;
use App\Services\Api\ProgramService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramController extends Controller
{
    public function __construct(
        protected ProgramService $programService
    ) {
    }

    public function signUp(int $id, ProgramSignUpDTO $programSignUpDTO): array|JsonResponse
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->signUp($program, $programSignUpDTO);
    }

    public function lessons(int $id): array
    {
        $program = Program::query()->findOrFail($id);

        return $program?->lessons->toArray();
    }

    public function lesson(int $id, int $lessonId): array
    {
        $program = Program::query()->findOrFail($id);

        $lesson = $program?->lessons->where('id', $lessonId)->first();

        return $this->programService->lesson($lesson);
    }

    public function storeExercises(int $id, int $lessonId, ProgramStoreExerciseDTO $programStoreExerciseDTO): array|JsonResponse
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->storeExercises($program, $lessonId, $programStoreExerciseDTO);
    }

    public function updateExercise(int $id, int $lessonId, int $exerciseId, UpdateExerciseDTO $updateExerciseDTO): array|JsonResponse
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->updateExercise($program, $lessonId, $exerciseId, $updateExerciseDTO);
    }

    public function storeLesson(int $id, ProgramStoreLessonDTO $programStoreLessonDTO): array|JsonResponse
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->storeLesson($program, $programStoreLessonDTO);
    }

    public function removeLesson(int $id, int $lessonId): JsonResponse|Response
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->removeLesson($program, $lessonId);
    }

    public function updateLesson(int $id, int $lessonId, UpdateLessonDTO $updateLessonDTO): array|JsonResponse
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->updateLesson($program, $lessonId, $updateLessonDTO);
    }

    public function removeExercises(int $id, int $lessonId, int $exerciseId): JsonResponse|Response
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->removeExercises($program, $lessonId, $exerciseId);
    }

    public function solutionsSolve(int $id, int $lessonId, int $exerciseId, SolutionSolveDTO $solutionSolveDTO): JsonResponse|Response|array
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->solutionsSolve($program, $lessonId, $exerciseId, $solutionSolveDTO);
    }

    public function solutionsVerify(int $id, int $lessonId, int $exerciseId, SolutionVerifyDTO $solutionVerifyDTO): JsonResponse|Response|array
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->solutionsVerify($program, $lessonId, $exerciseId, $solutionVerifyDTO);
    }

    public function getListSolutions(int $id, int $lessonId, int $exerciseId, Request $request): JsonResponse|Response|array
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->getListSolutions($program, $lessonId, $exerciseId, $request);
    }

    public function isSolved(int $id, int $lessonId, int $exerciseId): array|JsonResponse
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->isSolved($program, $lessonId, $exerciseId);
    }

    public function show(int $id): array
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->show($program);
    }

    public function list(): array
    {
        $programs = Program::all();

        return $this->programService->list($programs);
    }

    public function getExercises(int $id, int $lessonId): array
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->getExercises($program, $lessonId);
    }
}
