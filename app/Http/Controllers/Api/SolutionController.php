<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\Models\Program;
use App\Models\Solution;
use App\Models\User;
use App\Services\Api\ProgramService;
use App\Services\Api\SolutionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SolutionController extends Controller
{
    public function __construct(
        protected SolutionService $solutionService
    ) {
    }

    public function childrensMarks(int $userId): array|JsonResponse
    {
        $user = User::query()->findOrFail($userId);

        return $this->solutionService->childrensMarks($user);
    }

    public function studentsMarks(int $userId): array
    {
        $user = User::query()->findOrFail($userId);

        return $this->solutionService->studentsMarks($user);
    }
}
