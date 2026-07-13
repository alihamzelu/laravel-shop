<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // Products
            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            // Categories
            'categories.view',
            'categories.create',
            'categories.edit',
            'categories.delete',

            // Brands
            'brands.view',
            'brands.create',
            'brands.edit',
            'brands.delete',

            // Orders
            'orders.view',
            'orders.update',

            // Deals
            'deals.view',
            'deals.create',
            'deals.edit',
            'deals.delete',

            // Reviews
            'reviews.view',
            'reviews.manage',

            // Reports
            'reports.view',
        ];


        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }


        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
        ]);

        $customer = Role::firstOrCreate([
            'name' => 'customer',
        ]);


        // Super Admin
        $superAdmin->syncPermissions(
            Permission::all()
        );


        // Admin
        $admin->syncPermissions([

            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            'categories.view',
            'categories.create',
            'categories.edit',
            'categories.delete',

            'brands.view',
            'brands.create',
            'brands.edit',
            'brands.delete',

            'orders.view',
            'orders.update',

            'deals.view',
            'deals.create',
            'deals.edit',
            'deals.delete',

            'reviews.view',
            'reviews.manage',

            'reports.view',
        ]);


        // Customer
        $customer->syncPermissions([]);
    }
}