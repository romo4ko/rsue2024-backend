<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Avatar;
use App\Services\Api\UserService;
use Illuminate\Http\JsonResponse;

class AvatarController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function list(): array
    {
        return Avatar::all()->toArray();
    }

    public function buy(int $id): JsonResponse
    {
        $avatar = Avatar::query()->findOrFail($id);

        return $this->userService->buyAvatar($avatar);
    }
}
