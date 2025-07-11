<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        if (User::exists()) {
            return;
        }

        User::factory()->create([
            'email' => 'admin@admin.admin',
            'password' => 'admin',
            'role' => RoleEnum::admin,
        ]);

        $user = User::factory()->create([
            'email' => 'user@user.user',
            'password' => 'user',
            'role' => RoleEnum::user,
        ]);

        Company::factory()->count(11)->create([
            'user_id' => $user->id,
            'created_by' => $user->id,
        ]);
    }
}
