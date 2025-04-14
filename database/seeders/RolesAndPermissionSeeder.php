<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

final class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::firstOrCreate(['name' => UserRoleEnum::Admin->value]);

        Role::firstOrCreate(['name' => UserRoleEnum::Moderator->value]);

        Role::firstOrCreate(['name' => UserRoleEnum::Coach->value]);

        Role::firstOrCreate(['name' => UserRoleEnum::Client->value]);
    }
}
