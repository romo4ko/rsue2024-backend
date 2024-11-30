<?php

namespace Database\Seeders;

use App\Models\Enums\Roles;
use App\Models\Exercise;
use App\Models\Lesson;
use App\Models\Program;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ListKidsSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = User::query()->create([
            'name' => fake()->firstName(),
            'login' => fake()->name(),
            'surname' => fake()->lastName(),
            'about' => fake()->text(),
            'is_confirmed' => true,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $teacher->assignRole(Roles::TEACHER->value);

        $parent = User::query()->create([
            'name' => fake()->firstName(),
            'login' => fake()->name(),
            'surname' => fake()->lastName(),
            'about' => fake()->text(),
            'is_confirmed' => true,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $parent->assignRole(Roles::PARENT->value);

        $child1 = User::query()->create([
            'name' => fake()->firstName(),
            'login' => fake()->name(),
            'surname' => fake()->lastName(),
            'about' => fake()->text(),
            'is_confirmed' => true,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'parent_id' => $parent->id,
        ]);

        $child2 = User::query()->create([
            'name' => fake()->firstName(),
            'login' => fake()->name(),
            'surname' => fake()->lastName(),
            'about' => fake()->text(),
            'is_confirmed' => true,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'parent_id' => $parent->id,
        ]);

        $child3 = User::query()->create([
            'name' => fake()->firstName(),
            'login' => fake()->name(),
            'surname' => fake()->lastName(),
            'about' => fake()->text(),
            'is_confirmed' => true,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'parent_id' => $parent->id,
        ]);

        $child1->assignRole(Roles::STUDENT->value);
        $child2->assignRole(Roles::STUDENT->value);
        $child3->assignRole(Roles::STUDENT->value);

        $program1 = Program::query()->create([
            'name' => fake()->name(),
            'description' => fake()->text(),
        ]);
        $program2 = Program::query()->create([
            'name' => fake()->name(),
            'description' => fake()->text(),
        ]);

        $program1->users()->attach($child1);
        $program1->users()->attach($child2);
        $program1->users()->attach($child3);

        $program2->users()->attach($child1);
        $program2->users()->attach($child2);
        $program2->users()->attach($child3);

        $lesson1 = Lesson::query()->create([
            'name' => fake()->name(),
            'program_id' => $program1->id,
        ]);
        $lesson2 = Lesson::query()->create([
            'name' => fake()->name(),
            'program_id' => $program1->id,
        ]);
        $lesson3 = Lesson::query()->create([
            'name' => fake()->name(),
            'program_id' => $program2->id,
        ]);
        $lesson4 = Lesson::query()->create([
            'name' => fake()->name(),
            'program_id' => $program2->id,
        ]);

        $child1->lessons()->attach($lesson1);
        $child1->lessons()->attach($lesson2);
        $child1->lessons()->attach($lesson3);
        $child1->lessons()->attach($lesson4);

        $child2->lessons()->attach($lesson1);
        $child2->lessons()->attach($lesson2);
        $child2->lessons()->attach($lesson3);
        $child2->lessons()->attach($lesson4);

        $child3->lessons()->attach($lesson1);
        $child3->lessons()->attach($lesson2);
        $child3->lessons()->attach($lesson3);
        $child3->lessons()->attach($lesson4);

        $exercise1 = Exercise::query()->create([
            'points' => random_int(1, 5),
            'lesson_id' => $lesson1->id
        ]);
        $exercise2 = Exercise::query()->create([
            'points' => random_int(1, 5),
            'lesson_id' => $lesson2->id
        ]);
        $exercise3 = Exercise::query()->create([
            'points' => random_int(1, 5),
            'lesson_id' => $lesson3->id
        ]);
        $exercise4 = Exercise::query()->create([
            'points' => random_int(1, 5),
            'lesson_id' => $lesson4->id
        ]);

        Solution::query()->create([
            'student_id' => $child1->id,
            'teacher_id' => $teacher->id,
            'exercise_id' => $exercise1->id,
            'mark' => random_int(1, 5),
        ]);

        Solution::query()->create([
            'student_id' => $child2->id,
            'teacher_id' => $teacher->id,
            'exercise_id' => $exercise2->id,
            'mark' => random_int(1, 5),
        ]);

        Solution::query()->create([
            'student_id' => $child3->id,
            'teacher_id' => $teacher->id,
            'exercise_id' => $exercise3->id,
            'mark' => random_int(1, 5),
        ]);

        Solution::query()->create([
            'student_id' => $child1->id,
            'teacher_id' => $teacher->id,
            'exercise_id' => $exercise4->id,
            'mark' => random_int(1, 5),
        ]);
    }
}
