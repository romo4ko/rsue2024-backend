<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Character;
use App\Services\Api\UserService;
use Illuminate\Http\JsonResponse;

class CharacterController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function list(): array
    {
        return Character::all()->toArray();
    }

    public function buy(int $id): JsonResponse
    {
        $character = Character::query()->findOrFail($id);

        return $this->userService->buyCharacter($character);
    }
}
