<?php

namespace App\Filament\Resources\DepositTransactions\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\DepositTransaction;

class DepositOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Transaksi Setoran', DepositTransaction::count())
                ->descriptionIcon('heroicon-m-banknotes')
                ->description('Jumlah seluruh transaksi setoran')
                ->color('info'),

            Stat::make('Total Saldo Setoran', 'Rp ' . number_format(DepositTransaction::sum('total_amount'), 0, ',', '.'))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->description('Total saldo dari transaksi setoran')
                ->color('success')
        ];
    }
}
