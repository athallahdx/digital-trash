<?php

namespace App\Filament\Resources\DepositTransactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DepositTransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('transaction_number')
                    ->label('Nomor Transaksi')
                    ->placeholder('-'),
                TextEntry::make('customer.name')
                    ->label('Nama Nasabah')
                    ->label('Customer'),
                TextEntry::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->date(),
                TextEntry::make('total_amount')
                    ->label('Jumlah Setoran')
                    ->prefix('Rp')
                    ->numeric(),
                TextEntry::make('notes')
                    ->label('Catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Dicatat Pada')
                    ->dateTime(),
            ]);
    }
}
