<?php

namespace App\Filament\Resources\WithdrawalTransactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WithdrawalTransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('transaction_number')
                    ->label('Nomor Transaksi')
                    ->placeholder('-'),
                TextEntry::make('customer.name')
                    ->label('Nama Nasabah'),
                TextEntry::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->date(),
                TextEntry::make('amount')
                    ->label('Jumlah Penarikan')
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
