<?php

namespace App\Filament\Resources\Ledgers\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\DepositTransaction;
use App\Models\WithdrawalTransaction;

class LedgerOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Transaksi', DepositTransaction::count() + WithdrawalTransaction::count())
                ->descriptionIcon('heroicon-m-banknotes')
                ->description('Jumlah seluruh transaksi setoran dan penarikan')
                ->color('info'),

            Stat::make('Total Transaksi Setoran', DepositTransaction::count())
                ->descriptionIcon('heroicon-m-banknotes')
                ->description('Jumlah transaksi setoran')
                ->color('success'),

            Stat::make('Total Saldo Setoran', 'Rp ' . number_format(DepositTransaction::sum('total_amount'), 0, ',', '.'))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->description('Total saldo dari transaksi setoran')
                ->color('success'),

            Stat::make('Total Transaksi Penarikan', WithdrawalTransaction::count())
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->description('Jumlah transaksi penarikan')
                ->color('danger'),

            Stat::make('Total Saldo Penarikan', 'Rp ' . number_format(WithdrawalTransaction::sum('amount'), 0, ',', '.'))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->description('Total saldo dari transaksi penarikan')
                ->color('danger'),
        ];
    }
}
