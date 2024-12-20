<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Models\Enums\Roles;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class SolutionService
{
    public function childrensMarks(User $user): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::PARENT->value) {
            return response()->json(['message' => 'Пользователь не может получить список успеваемости так как он не родитель'], 403);
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

    public function studentsMarks(User $user): array|JsonResponse
    {
        if (auth()->user()?->roles->pluck('name')[0] !== Roles::TEACHER->value) {
            return response()->json(['message' => 'Пользователь не может получить список успеваемости так как он не преподаватель'], 403);
        }

        $childrens = User::with(['programs.lessons.exercises.solutions' => function($query) use($user) {
            $query->whereNotNull('solutions.mark')->where('solutions.teacher_id', $user->id);
        }])
            ->with(['programs.lessons' => function ($query) {
                $query->has('exercises');
            }])
            ->has('programs.lessons.exercises.solutions')
            ->get();

        return $childrens->toArray();
    }
}
