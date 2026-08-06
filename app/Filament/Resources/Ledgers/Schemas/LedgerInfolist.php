<?php

namespace App\Filament\Resources\Ledgers\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;

class LedgerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer_number')
                    ->label('Nomor Rekening')
                    ->placeholder('-'),
                TextEntry::make('name')
                    ->label('Nama')
                    ->placeholder('-'),
                TextEntry::make('balance')
                    ->prefix('Rp')
                    ->label('Saldo')
                    ->numeric(),
                TextEntry::make('address')
                    ->label('Alamat')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('phone')
                    ->label('Nomor Telepon')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ]);
    }
}
