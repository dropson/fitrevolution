<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\CurrencyEnum;
use App\Enums\UserGenderEnum;
use App\Enums\UserRoleEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolesAndPermissionSeeder::class,
            ExerciseSeeder::class,
        ]);

        $client = User::factory()->create([
            'first_name' => 'Gina',
            'last_name' => 'Linetti',
            'gender' => UserGenderEnum::Female->value,
            'email' => 'client@example.com',
        ]);
        $client->clientProfile()->create([
            'weight' => 160,
            'height' => 48,
        ]);
        $client->assignRole(UserRoleEnum::Client->value);
        $client->workoutTemplatesForClient()->create([
            'title' => 'Chest day',
            'instruction' => 'Lorem, ipsum dolor sit amet consectetur adipisicing.',
        ]);
        $coach = User::factory()->create([
            'first_name' => 'Terry',
            'last_name' => 'Jeffords',
            'gender' => UserGenderEnum::Male->value,
            'email' => 'coach@example.com',
        ]);
        $coach->coachProfile()->create([
            'price' => 900,
            'currency' => CurrencyEnum::EUR->value,
        ]);
        $coach->assignRole(UserRoleEnum::Coach->value);
    }
}
