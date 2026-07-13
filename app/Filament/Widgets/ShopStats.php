<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ShopStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Products', Product::count())
                ->description('Total products')
                ->icon('heroicon-o-cube'),

            Stat::make('Customers', User::count())
                ->description('Registered users')
                ->icon('heroicon-o-users'),

            Stat::make('Orders', Order::count())
                ->description('Total orders')
                ->icon('heroicon-o-shopping-cart'),

            Stat::make(
                'Revenue',
                number_format(
                    Order::where('status', 'completed')
                        ->sum('total_price')
                ) . ' IRR'
            )
                ->description('Completed orders')
                ->icon('heroicon-o-banknotes'),
        ];
    }
    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole([
            'super-admin',
            'admin',
            'manager',
        ]);
    }
}
