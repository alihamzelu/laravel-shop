<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
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
            'orders.delete',

            // Users
            'users.view',
            'users.manage',

            // Deals
            'deals.view',
            'deals.create',
            'deals.edit',
            'deals.delete',

            // Reviews
            'reviews.manage',

            // Reports
            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}