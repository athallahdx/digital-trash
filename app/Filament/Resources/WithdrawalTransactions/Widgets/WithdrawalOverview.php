<?php

namespace App\Filament\Resources\WithdrawalTransactions\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use App\Models\WithdrawalTransaction;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WithdrawalOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Transaksi Penarikan', WithdrawalTransaction::count())
                ->descriptionIcon('heroicon-m-banknotes')
                ->description('Jumlah seluruh transaksi penarikan')
                ->color('info'),

            Stat::make('Total Saldo Penarikan', 'Rp ' . number_format(WithdrawalTransaction::sum('amount'), 0, ',', '.'))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->description('Total saldo dari transaksi penarikan')
                ->color('danger')
        ];
    }
}
