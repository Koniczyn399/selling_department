<?php

namespace Database\Seeders;

use App\Enums\Auth\PermissionType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => PermissionType::USER_ACCESS->value]);
        Permission::create(['name' => PermissionType::USER_MANAGE->value]);

        Permission::create(['name' => PermissionType::CATEGORY_ACCESS->value]);
        Permission::create(['name' => PermissionType::KOMPONENT_ACCESS->value]);
        Permission::create(['name' => PermissionType::DEVICE_ACCESS->value]);
        Permission::create(['name' => PermissionType::MANUFACTURER_ACCESS->value]);
        Permission::create(['name' => PermissionType::ORDERSTATE_ACCESS->value]);

        Permission::create(['name' => PermissionType::CATEGORY_MANAGE->value]);
        Permission::create(['name' => PermissionType::KOMPONENT_MANAGE->value]);
        Permission::create(['name' => PermissionType::DEVICE_MANAGE->value]);
        Permission::create(['name' => PermissionType::MANUFACTURER_MANAGE->value]);
        Permission::create(['name' => PermissionType::ORDERSTATE_MANAGE->value]);

        Permission::create(['name' => PermissionType::ORDER_ACCESS->value]);
        Permission::create(['name' => PermissionType::ORDER_MANAGE->value]);

        Permission::create(['name' => PermissionType::ORDER_PRODUCT_ACCESS->value]);
        Permission::create(['name' => PermissionType::ORDER_PRODUCT_MANAGE->value]);

        Permission::create(['name' => PermissionType::COMMISSION_ACCESS->value]);
        Permission::create(['name' => PermissionType::COMMISSION_MANAGE->value]);

        Permission::create(['name' => PermissionType::COMMISSION_KOMPONENT_ACCESS->value]);
        Permission::create(['name' => PermissionType::COMMISSION_KOMPONENT_MANAGE->value]);

        Permission::create(['name' => PermissionType::SERVICE_ACCESS->value]);
        Permission::create(['name' => PermissionType::SERVICE_MANAGE->value]);

        Permission::create(['name' => PermissionType::PRODUCT_ACCESS->value]);
        Permission::create(['name' => PermissionType::PRODUCT_MANAGE->value]);

        Permission::create(['name' => PermissionType::COMMISSION_SERVICE_ACCESS->value]);
        Permission::create(['name' => PermissionType::COMMISSION_SERVICE_MANAGE->value]);

        Permission::create(['name' => PermissionType::ORDER_DETAIL_ACCESS->value]);




    }
}
