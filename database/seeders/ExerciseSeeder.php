<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use App\Models\Exercise;
use Illuminate\Database\Seeder;

final class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $exercises = [
            [
                'title' => 'Barbell Bench Press',
                'muscle_group' => MuscleGroupEnum::Chest->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The barbell chest press, also known as the barbell bench press, is a fundamental exercise for building upper body strength, specifically targeting the pectoral muscles, triceps, and shoulders. ',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Incline Bench Press',
                'muscle_group' => MuscleGroupEnum::Chest->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The Dumbbell Incline Bench Press is an effective exercise for targeting the upper portion of the pectoral muscles, as well as the shoulders and triceps. ',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Fly',
                'muscle_group' => MuscleGroupEnum::Chest->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The Dumbbell Fly is a great exercise for targeting the chest muscles, particularly the pectoralis major.',
                'created_by' => null,
            ],
            [
                'title' => 'Barbell Incline Bench Press',
                'muscle_group' => MuscleGroupEnum::Chest->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The barbell incline bench press is an excellent exercise for targeting the upper portion of the pectoral muscles, as well as the shoulders and triceps.',
                'created_by' => null,
            ],
            [
                'title' => 'Push-Up',
                'muscle_group' => MuscleGroupEnum::Chest->value,
                'equipment' => EquipmentEnum::None->value,
                'instruction' => 'The push-up is a fundamental bodyweight exercise that primarily targets the chest, shoulders, and triceps, while also engaging the core and other stabilizing muscles.',
                'created_by' => null,
            ],
            [
                'title' => 'EZ Bar Tricep Extension',
                'muscle_group' => MuscleGroupEnum::Triceps->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The EZ bar triceps extension exercise combines a decline bench and a curved bar to effectively work the tricep muscle.',
                'created_by' => null,
            ],
            [
                'title' => 'Dip',
                'muscle_group' => MuscleGroupEnum::Triceps->value,
                'equipment' => EquipmentEnum::Machine->value,
                'instruction' => 'Performing a bodyweight dip is an excellent way to build strength in the triceps, chest, and shoulders.',
                'created_by' => null,
            ],
            [
                'title' => 'Cable Tricep Pushdown ',
                'muscle_group' => MuscleGroupEnum::Triceps->value,
                'equipment' => EquipmentEnum::Machine->value,
                'instruction' => 'The rope triceps pushdown exercise uses a rope to target the triceps muscle for better definition and bigger arms.',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Seated Tricep Press ',
                'muscle_group' => MuscleGroupEnum::Triceps->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The seated triceps press exercise uses a single dumbbell held in between both hands to work the tricep muscle and build bigger arms.',
                'created_by' => null,
            ],
            [
                'title' => 'Barbell Deadlift ',
                'muscle_group' => MuscleGroupEnum::Back->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The barbell deadlift is a classic bodybuilding exercise meant for putting on mass and building overall strength throughout the entire body.',
                'created_by' => null,
            ],
            [
                'title' => 'Pull-Up ',
                'muscle_group' => MuscleGroupEnum::Back->value,
                'equipment' => EquipmentEnum::None->value,
                'instruction' => 'Pull-ups build up several muscles of the upper body, including the latissimus dorsi, trapezius, and biceps brachii.',
                'created_by' => null,
            ],
            [
                'title' => 'Barbell Bent-Over Row ',
                'muscle_group' => MuscleGroupEnum::Back->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The barbell bent-over row is a great exercise for building strength and mass in the back muscles, including the latissimus dorsi, rhomboids, trapezius, and rear deltoids, as well as the biceps.',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell One-Arm Row',
                'muscle_group' => MuscleGroupEnum::Back->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The one arm dumbbell row is a variation of the dumbbell row and an exercise used to build back muscle and strength.',
                'created_by' => null,
            ],
            [
                'title' => 'Cable Shoulder Extension',
                'muscle_group' => MuscleGroupEnum::Back->value,
                'equipment' => EquipmentEnum::Machine->value,
                'instruction' => 'The cable shoulder extension exercise is another great way to work the back, specifically the latissiumus dorsi muscle.',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Alternating Hammer Curl',
                'muscle_group' => MuscleGroupEnum::Biceps->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The alternate hammer curl exercise uses a hammering (up and down) motion to isolate the biceps and to build bigger arms.',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Concentration Curl',
                'muscle_group' => MuscleGroupEnum::Biceps->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The dumbbell concentration curl exercise limits you range of motion and concentrates on isolating the bicep muscle.',
                'created_by' => null,
            ],
            [
                'title' => 'Barbell Squat',
                'muscle_group' => MuscleGroupEnum::Legs->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The barbell squat is a fundamental exercise for building lower body strength, targeting the quadriceps, hamstrings, glutes, and core.',
                'created_by' => null,
            ],
            [
                'title' => 'Barbell Romanian Deadlift',
                'muscle_group' => MuscleGroupEnum::Legs->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The romanian deadlift exercise is similar to the regular deadlift but differs because you keep your legs straight throughout the workout and bring the bar all the way to the ground at each rep.',
                'created_by' => null,
            ],
            [
                'title' => 'Pistol Squat',
                'muscle_group' => MuscleGroupEnum::Legs->value,
                'equipment' => EquipmentEnum::None->value,
                'instruction' => 'The pistol squat is one of the best exercises to develop strong, flexible, and resilient legs, but it also requires skill, practice, and consistency.',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Seated Shoulder Press',
                'muscle_group' => MuscleGroupEnum::Shoulder->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The Dumbbell Seated Shoulder Press is an excellent exercise for building strength and size in your shoulder muscles, particularly the deltoids, as well as engaging the triceps and upper chest.',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Lateral Raise',
                'muscle_group' => MuscleGroupEnum::Shoulder->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'A Dumbbell Lateral Raise is an effective exercise for targeting the lateral deltoid muscles, which are located on the sides of your shoulders.',
                'created_by' => null,
            ],
            [
                'title' => 'Barbell Military Press',
                'muscle_group' => MuscleGroupEnum::Shoulder->value,
                'equipment' => EquipmentEnum::Barbell->value,
                'instruction' => 'The military press is used primarily to build the deltoid muscle. It also indirectly targets the other muscles of the shoulder, your triceps, and your core.',
                'created_by' => null,
            ],
            [
                'title' => 'Dumbbell Seated Bent-Over Reverse Fly',
                'muscle_group' => MuscleGroupEnum::Shoulder->value,
                'equipment' => EquipmentEnum::Dumbbells->value,
                'instruction' => 'The seated bent over dumbbell reverse fly is a dumbbell reverse fly variation and an exercise used to strength then rear deltoids',
                'created_by' => null,
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::firstOrCreate($exercise);
        }
    }
}
