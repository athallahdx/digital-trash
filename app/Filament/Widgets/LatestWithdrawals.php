<?php

namespace App\Filament\Widgets;

use App\Models\WithdrawalTransaction;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestWithdrawals extends BaseWidget
{
    protected static ?string $heading = '10 Penarikan Terbaru';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return WithdrawalTransaction::query()
            ->with('customer')
            ->latest('transaction_date')
            ->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('transaction_number')
                ->label('Nomor'),

            Tables\Columns\TextColumn::make('customer.name')
                ->label('Nasabah'),

            Tables\Columns\TextColumn::make('amount')
                ->label('Jumlah')
                ->money('IDR', decimalPlaces: 0),

            Tables\Columns\TextColumn::make('transaction_date')
                ->label('Tanggal')
                ->date(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}