<?php

declare(strict_types=1);

namespace App\DTO\Api\Auth\Response;

use App\Models\User;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class UserRegisterShowDTO extends Data
{
    public function __construct(
        public User   $user,
        public string $token,
        public Collection $role,
    ) {
    }

    public static function fromMultiple(User $user, string $token): self
    {
        return new self(
            $user,
            $token,
            $user->getRoleNames()
        );
    }
}
