<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\Auth\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@user.com',
            'password' => Hash::make('12345678'),
        ])->assignRole(RoleType::USER->value);

        User::factory()->create([
            'name' => 'Test Worker',
            'email' => 'test@worker.com',
            'password' => Hash::make('12345678'),
        ])->assignRole(RoleType::WORKER->value);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('12345678'),
        ])->assignRole(RoleType::ADMIN->value);
    }
}
