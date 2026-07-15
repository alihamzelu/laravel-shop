<?php

namespace App\Filament\Resources\SupportTickets\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RepliesRelationManager extends RelationManager
{
    protected static string $relationship = 'replies';

    protected static ?string $title = 'Replies';


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')
                    ->label('User'),

                TextColumn::make('message')
                    ->limit(50),

                IconColumn::make('is_admin')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime(),

            ])

            ->headerActions([
                CreateAction::make()
                    ->label('Reply Ticket')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();
                        $data['is_admin'] = true;
                        return $data;
                    })
            ]);
    }
}
