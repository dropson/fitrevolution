<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::firstOrCreate(['name' => UserRoleEnum::Admin->value]);

        $moderator = Role::firstOrCreate(['name' => UserRoleEnum::Moderator->value]);

        $coach = Role::firstOrCreate(['name' => UserRoleEnum::Coach->value]);

        $client = Role::firstOrCreate(['name' => UserRoleEnum::Client->value]);
    }
}
