<?php
// phpcs:ignoreFile

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Enums\ExerciseType;
use App\Models\Exercise;
use App\Models\Lesson;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $program = Program::create([
            'name' => fake()->word(),
            'description' => fake()->text(),
            'image' => '',
            'min_student_age' => 5,
            'max_student_age' => 14,
        ]);

        foreach (range(1, 5) as $index) {
            $lesson = Lesson::create([
                'name' => fake()->word(),
                'theory' => fake()->text(),
                'program_id' => $program->id,
                'points' => 10,
            ]);

            foreach (range(1, 5) as $index) {
                Exercise::create([
                    'type' => ExerciseType::MANUAL,
                    'condition' => fake()->text(),
                    'answers' => [],
                    'points' => 5,
                    'lesson_id' => $lesson->id,
                ]);
            }
        }
    }
}
