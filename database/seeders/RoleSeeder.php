<?php

namespace Database\Seeders;

use App\Enums\Auth\PermissionType;
use App\Enums\Auth\RoleType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Uruchomienie konkretnego seedera:
        // sail artisan db:seed --class=RoleSeeder

        // Reset cache'a ról i uprawnień:
        // sail artisan permission:cache-reset
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => RoleType::ADMIN]);
        Role::create(['name' => RoleType::WORKER]);
        Role::create(['name' => RoleType::USER]);

        // ADMINISTRATOR SYSTEMU
        $adminRole = Role::findByName(RoleType::ADMIN->value);
        $adminRole->givePermissionTo(PermissionType::USER_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::USER_MANAGE->value);

        $adminRole->givePermissionTo(PermissionType::CATEGORY_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::DEVICE_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::MANUFACTURER_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::KOMPONENT_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::ORDERSTATE_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::COMMISSION_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::COMMISSION_KOMPONENT_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::COMMISSION_SERVICE_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::ORDER_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::ORDER_PRODUCT_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::SERVICE_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::PRODUCT_ACCESS->value);
        $adminRole->givePermissionTo(PermissionType::ORDER_DETAIL_ACCESS->value);

        $adminRole->givePermissionTo(PermissionType::CATEGORY_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::DEVICE_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::MANUFACTURER_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::KOMPONENT_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::ORDERSTATE_MANAGE->value);

        $adminRole->givePermissionTo(PermissionType::COMMISSION_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::COMMISSION_KOMPONENT_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::COMMISSION_SERVICE_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::ORDER_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::ORDER_PRODUCT_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::SERVICE_MANAGE->value);
        $adminRole->givePermissionTo(PermissionType::PRODUCT_MANAGE->value);


        // PRACOWNIK
        $workerRole = Role::findByName(RoleType::WORKER->value);
        $workerRole->givePermissionTo(PermissionType::USER_ACCESS->value);
        $workerRole->givePermissionTo(PermissionType::USER_MANAGE->value);


        $workerRole->givePermissionTo(PermissionType::CATEGORY_ACCESS->value);
        $workerRole->givePermissionTo(PermissionType::DEVICE_ACCESS->value);
        $workerRole->givePermissionTo(PermissionType::MANUFACTURER_ACCESS->value);
        $workerRole->givePermissionTo(PermissionType::KOMPONENT_ACCESS->value);
        $workerRole->givePermissionTo(PermissionType::ORDERSTATE_ACCESS->value);
        $workerRole->givePermissionTo(PermissionType::ORDER_DETAIL_ACCESS->value);


        // UŻYTKOWNIK
        $userRole = Role::findByName(RoleType::USER->value);
        $userRole->givePermissionTo(PermissionType::CATEGORY_ACCESS->value);
        $userRole->givePermissionTo(PermissionType::DEVICE_ACCESS->value);
        $userRole->givePermissionTo(PermissionType::MANUFACTURER_ACCESS->value);
        $userRole->givePermissionTo(PermissionType::ORDER_DETAIL_ACCESS->value);

    }
}
