<?php

namespace App\Filament\Resources\SupportTickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;

class SupportTicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                TextColumn::make('subject')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'answered',
                        'warning' => ['pending', 'open'],
                        'danger'  => 'closed',
                    ]),

                BadgeColumn::make('priority')
                    ->colors([
                        'danger' => 'high',
                        'warning' => 'medium',
                        'success' => 'low',
                    ]),

                TextColumn::make('created_at')
                    ->dateTime(),

            ])
            ->defaultSort('created_at', 'desc');
    }
}
