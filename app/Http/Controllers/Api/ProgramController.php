<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\User\Request\UserUpdateDTO;
use App\Models\Program;
use App\Models\User;
use App\Services\Api\ProgramService;
use App\Services\Api\UserService;
use Illuminate\Http\JsonResponse;

class ProgramController extends Controller
{
    public function __construct(
        protected ProgramService $programService
    ) {
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
