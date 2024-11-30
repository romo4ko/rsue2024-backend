<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\Program\Request\ProgramSignUpDTO;
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
}
