<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class SalesChart extends ChartWidget
{
    protected ?string $heading = 'Sales Last 7 Days';

    protected function getData(): array
    {
        $sales = [];

        $labels = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i);

            $labels[] = $date->format('M d');

            $sales[] = Order::whereDate(
                'created_at',
                $date->format('Y-m-d')
            )
                ->where('status', 'completed')
                ->sum('total_price');
        }


        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => $sales,
                ],
            ],

            'labels' => $labels,
        ];
    }


    protected function getType(): string
    {
        return 'line';
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
