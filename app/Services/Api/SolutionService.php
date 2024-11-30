<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Mark\Response\ProgramWithMarksShowDTO;
use App\Models\Enums\Roles;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SolutionService
{
    public function childrensMarks(User $user): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::PARENT->value) {
            return response()->json(['message' => 'Пользователь не может получить список успеваемости так ка кон не родитель'], 403);
        }

        $childrens = User::with(['programs.lessons.exercises.solutions' => function($query) {
            $query->whereNotNull('solutions.mark');
        }])
            ->where('parent_id', $user->id)
            ->get();

        return $childrens->toArray();
    }
}
