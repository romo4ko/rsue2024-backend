<?php

namespace App\DTO\Api\User\Response;

use App\Models\User;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class UserShowDTO extends Data
{
    public function __construct(
        public User $user,
        public bool $isEditor,
        public Collection $role
    ){
    }

    public static function fromModel(User $user): self
    {
        return new self(
            $user,
            $user->id === auth()->id(),
            $user->getRoleNames()
        );
    }
}
