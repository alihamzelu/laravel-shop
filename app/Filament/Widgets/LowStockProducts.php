<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LowStockProducts extends TableWidget
{
    protected static ?string $heading = 'Low Stock Products';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder => Product::query()
                    ->where('stock', '<=', 5)
                    ->orderBy('stock')
            )
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Product')
                    ->searchable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->badge(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('IRR'),

            ]);
    }
    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole([
            'super-admin',
            'admin',
            'warehouse',
        ]);
    }
}
