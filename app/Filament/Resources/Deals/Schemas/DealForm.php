<?php

namespace App\Filament\Resources\Deals\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DealForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('product_id')
                    ->label('Product')
                    ->options(
                        Product::pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(),

                TextInput::make('discount_percent')
                    ->label('Discount (%)')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100)
                    ->required(),

                DatePicker::make('start_date')
                    ->required(),

                DatePicker::make('end_date')
                    ->required(),

            ]);
    }
}