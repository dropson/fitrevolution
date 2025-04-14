<?php

declare(strict_types=1);

namespace Database\Seeders;

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

        $user = User::factory()->create([
            'first_name' => 'Paul',
            'last_name' => 'Jillinhal',
            'gender' => UserGenderEnum::Male->value,
            'email' => 'test@example.com',
        ]);

        $user->assignRole(UserRoleEnum::Client->value);
    }
}
