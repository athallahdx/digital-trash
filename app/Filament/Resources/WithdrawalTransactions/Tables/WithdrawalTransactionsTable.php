<?php

namespace App\Filament\Resources\WithdrawalTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WithdrawalTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction_number')
                    ->label('Nomor Transaksi')
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->label('Nama Nasabah')
                    ->searchable(),
                TextColumn::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->date()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Jumlah Penarikan')
                    ->money('IDR', decimalPlaces: 0)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dicatat Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
