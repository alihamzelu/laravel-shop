<?php

namespace App\Filament\Resources\SupportTickets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SupportTicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('subject')
                    ->required(),

                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'pending' => 'Pending',
                        'answered' => 'Answered',
                        'closed' => 'Closed',
                    ])
                    ->required(),

                Select::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->required(),

            ]);
    }
}
