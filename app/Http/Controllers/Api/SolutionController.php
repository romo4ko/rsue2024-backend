<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\Program\Request\ProgramSignUpDTO;
use App\DTO\Api\Program\Request\ProgramStoreLessonDTO;
use App\Models\Program;
use App\Models\Solution;
use App\Services\Api\ProgramService;
use Illuminate\Http\JsonResponse;

class SolutionController extends Controller
{
    public function __construct(
        protected ProgramService $programService
    ) {
    }

    public function list(): array
    {
        $solutions = Solution::all();

        return $this->programService->list($solutions);
    }
}
