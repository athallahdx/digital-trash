<?php

namespace App\Filament\Resources\Ledgers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;


class LedgerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_number')
                    ->label('Nomor Rekening')
                    ->disabled(),
                TextInput::make('name')
                    ->label('Nama')
                    ->disabled()
                    ->required(),
                TextInput::make('balance')
                    ->label('Saldo')
                    ->required()
                    ->disabled()
                    ->prefix('Rp')
                    ->numeric()
                    ->default(0),
                Textarea::make('address')
                    ->label('Alamat')
                    ->disabled()
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->disabled()
                    ->tel(),
                Toggle::make('is_active')
                    ->label('Status')
                    ->disabled()
                    ->required(),
            ]);
    }
}
