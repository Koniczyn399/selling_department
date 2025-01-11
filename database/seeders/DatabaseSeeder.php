<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(ManufacturerSeeder::class);

        $this->call(OrderStateSeeder::class);
 


        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);

        $this->call(OrderProductSeeder::class);

      
    }
}
