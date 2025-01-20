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

        User::factory(25)->create();

        User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'nip' => '123123123',
            'city' => 'testowe_miasto',
            'street' => 'testowa_ulica',
            'street_number' => 'testowy_numer',
            'post_code' => 'testowy_kod_pocztowy',
            'description' => 'testowy_opis',
            'email' => 'test@user.com',
            'password' => Hash::make('12345678'),
            'position' => 'test_user',
        ])->assignRole(RoleType::USER->value);

        User::factory()->create([
            'name' => 'Test',
            'last_name' => 'worker',
            'nip' => '123123123',
            'city' => 'testowe_miasto',
            'street' => 'testowa_ulica',
            'street_number' => 'testowy_numer',
            'post_code' => 'testowy_kod_pocztowy',
            'description' => 'testowy_opis',
            'email' => 'test@worker.com',
            'position' => 'test_worker',
            'password' => Hash::make('12345678'),
        ])->assignRole(RoleType::WORKER->value);

        User::factory()->create([
            'name' => 'Admin',
            'last_name' => 'Kowalski',
            'nip' => '123123123',
            'city' => 'testowe_miasto',
            'street' => 'testowa_ulica',
            'street_number' => 'testowy_numer',
            'post_code' => 'testowy_kod_pocztowy',
            'description' => 'testowy_opis',
            'email' => 'test@admin.com',
            'position' => 'test_admin',
            'password' => Hash::make('12345678'),
        ])->assignRole(RoleType::ADMIN->value);
    }
}
