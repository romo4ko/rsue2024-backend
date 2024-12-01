<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\User\Request\UserUpdateDTO;
use App\DTO\Api\User\Response\AchievementShowDTO;
use App\DTO\Api\User\Response\UserShowDTO;
use App\Models\Avatar;
use App\Models\Character;
use App\Models\Enums\Roles;
use App\Models\Lesson;
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

    public function handleLesson(User $user, int $programId, int $lessonId): JsonResponse
    {
        $lesson = Lesson::query()->where('id', $lessonId)->where('program_id', $programId)->firstOrFail();

        $user->lessons()->attach($lesson);
        $user->balance += $lesson->points ?? 0;
        $user->save();

        return new JsonResponse();
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

    public function buyAvatar(Avatar $avatar): JsonResponse
    {
        $user = User::query()->findOrFail(auth()->user()->id);
        if ($user?->roles->pluck('name')[0] !== Roles::STUDENT->value) {
            throw new \Exception('Только ученики могут покупать аватары');
        }
        if ($user->balance < $avatar->price) {
            throw new \Exception('Недостаточно средств для покупки аватара');
        }

        $user->balance -= $avatar->price;
        $user->avatars()->attach($avatar);
        $user->image = $avatar->image;
        $user->save();

        return new JsonResponse();
    }

    public function buyCharacter(Character $character): JsonResponse
    {
        $user = User::query()->findOrFail(auth()->user()->id);
        if ($user?->roles->pluck('name')[0] !== Roles::STUDENT->value) {
            throw new \Exception('Только ученики могут покупать персонажей');
        }
        if ($user->balance < $character->price) {
            throw new \Exception('Недостаточно средств для покупки персонажа');
        }

        $user->balance -= $character->price;
        $user->character()->attach($character);
        $user->image = $character->image;
        $user->save();

        return new JsonResponse();
    }

    public function storeTelegram($username): JsonResponse
    {
        $user = User::query()->findOrFail(auth()->user()->id);
        $user->telegram_username = $username;
        $user->save();

        return new JsonResponse();
    }
}
