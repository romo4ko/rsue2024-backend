<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\User\Request\UserUpdateDTO;
use App\DTO\Api\User\Response\AchievementShowDTO;
use App\DTO\Api\User\Response\UserShowDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function show(User|null $user): array
    {
        if ($user) {
            return UserShowDTO::from($user)->toArray();
        }

        return [];
    }

    public function update(User|null $user, UserUpdateDTO $userUpdateDTO): array|JsonResponse
    {
        if(!$user) {
            return [];
        }

        if ($user->id === auth()->id()) {
            $savedImage = null;

            if ($userUpdateDTO->image) {
                $savedImage = $userUpdateDTO->image->store(options: ['disk' => 'public']);
            }

            $user->update([
                'image' => Storage::disk('public')->url($savedImage),
                'name' => $userUpdateDTO->name,
                'surname' => $userUpdateDTO->surname,
                'patronymic' => $userUpdateDTO->patronymic,
                'email' => $userUpdateDTO->email,
                'about' => $userUpdateDTO->about,
            ]);

            return $user->toArray();
        }

        return response()->json(['message' => 'just meme'], 403);
    }

    public function childrens(User $user): array
    {
        $childrens = User::with('roles')->where('parent_id', $user->id);

        return $childrens->get()->toArray();
    }

    public function achievements(User $user): array
    {
        $achievements = $user->achievements()->get();

        return $achievements->map(
            fn($achievement) => AchievementShowDTO::fromModel($achievement)
        )->toArray();
    }
}
