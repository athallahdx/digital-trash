<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\DepositTransaction;
use App\Models\WithdrawalTransaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Nasabah', Customer::where('is_active', true)->count())
                ->description('Nasabah terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Total Transaksi Setoran', DepositTransaction::count())
                ->description('Jumlah seluruh transaksi setoran')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),

            Stat::make('Total Transaksi Penarikan', WithdrawalTransaction::count())
                ->description('Jumlah seluruh transaksi penarikan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),

            Stat::make(
                'Saldo Tersimpan',
                'Rp ' . number_format(Customer::sum('balance'), 0, ',', '.')
            )
                ->description('Saldo seluruh nasabah')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make(
                'Total Setoran',
                'Rp ' . number_format(DepositTransaction::sum('total_amount'), 0, ',', '.')
            )
                ->description('Akumulasi seluruh setoran')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make(
                'Total Penarikan',
                'Rp ' . number_format(WithdrawalTransaction::sum('amount'), 0, ',', '.')
            )
                ->description('Akumulasi seluruh penarikan')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('danger'),

        ];
    }
}