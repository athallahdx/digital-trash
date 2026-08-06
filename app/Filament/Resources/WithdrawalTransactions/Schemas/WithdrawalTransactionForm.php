<?php

namespace App\Filament\Resources\WithdrawalTransactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WithdrawalTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('transaction_number')
                    ->label('Nomor Transaksi')
                    ->disabled(fn (string $operation) => $operation === 'create')
                    ->dehydrated(fn (string $operation) => $operation !== 'create')
                    ->helperText(fn (string $operation) => $operation === 'create'
                        ? 'Nomor transaksi akan otomatis dibuat oleh sistem. Anda dapat mengubahnya setelah data berhasil dibuat.'
                        : null)
                    ->placeholder('-'),
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable(['customer_number', 'name'])
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => "{$record->customer_number} - {$record->name}"
                    )
                    ->label('Nasabah')
                    ->required(),
                DatePicker::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->default(now())
                    ->required(),
                TextInput::make('amount')
                    ->label('Jumlah Penarikan')
                    ->required()
                    ->prefix('Rp')
                    ->numeric()
                    ->default(0),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }
}
