<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::findOrCreate('Admin');
        Role::findOrCreate('User');
        Role::findOrCreate('Seller');

        Permission::findOrCreate('manage-users');
        Permission::findOrCreate('manage-sellers');
        Permission::findOrCreate('manage-products');
        Permission::findOrCreate('manage-categories');
        Permission::findOrCreate('manage-transaction');

        Permission::findOrCreate('view-transactions');
        Permission::findOrCreate('view-products');
        Permission::findOrCreate('make-transactions');

        Permission::findOrCreate('addProductsToCart');
        Permission::findOrCreate('viewCart');

        $adminRole = Role::findByName('Admin');
        // dd($adminRole);
        $adminRole->givePermissionTo([
            'manage-users',
            'manage-sellers',
            'manage-products',
            'manage-categories',
            'manage-transaction',
        ]);

        $sellerRole = Role::findByName('Seller');
        $sellerRole->givePermissionTo([
            'manage-products',
            'manage-transaction',
        ]);

        $userRole = Role::findByName('User');
        $userRole->givePermissionTo([
            'view-products',
            'make-transactions',
            'view-transactions',
            'addProductsToCart',
            'viewCart',
        ]);

    }
}
