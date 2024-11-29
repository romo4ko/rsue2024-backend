<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

        if (Role::query()->count() === 0) {
            Role::create(['name' => Roles::Teacher->value]);
            Role::create(['name' => Roles::Parent->value]);
            Role::create(['name' => Roles::Student->value]);
        }

        User::all()->where('is_admin', false)->each(function ($user) {
            $user->assignRole(Role::all()->random()->name);
        });
    }
}
