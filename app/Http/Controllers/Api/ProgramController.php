<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\Models\Program;
use App\Services\Api\ProgramService;
use Illuminate\Http\JsonResponse;

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
        $program = Program::with(['lessons.exercises'])->findOrFail($id);

        $lesson = $program?->lessons->where('id', $lessonId)->first();

        return $lesson ? $lesson->toArray() : [];
    }

    public function storeLesson(int $id, ProgramStoreLessonDTO $programStoreLessonDTO): array|JsonResponse
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->storeLesson($program, $programStoreLessonDTO);
    }

    public function show(int $id): array
    {
        $program = Program::query()->findOrFail($id);

        return $this->programService->storeLesson($program);
    }

    public function list(): array
    {
        $programs = Program::all();

        return $this->programService->list($programs);
    }
}
