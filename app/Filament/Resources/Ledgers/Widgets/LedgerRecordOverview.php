<?php

namespace App\Filament\Resources\Ledgers\Widgets;

use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LedgerRecordOverview extends StatsOverviewWidget
{
    public Customer $record;

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Saldo Rekening',
                'Rp ' . number_format($this->record->balance, 0, ',', '.')
            )
                ->description('Total saldo rekening nasabah')
                ->descriptionIcon('heroicon-m-wallet')
                ->color('primary'),

            Stat::make(
                'Total Transaksi',
                $this->record->depositTransactions()->count()
                + $this->record->withdrawalTransactions()->count()
            )
                ->description('Jumlah seluruh transaksi')
                ->descriptionIcon('heroicon-m-arrows-right-left')
                ->color('primary'),

            Stat::make(
                'Total Setoran',
                $this->record->depositTransactions()->count()
            )
                ->description('Jumlah transaksi setoran')
                ->descriptionIcon('heroicon-m-arrow-down-circle')
                ->color('success'),

            Stat::make(
                'Nominal Setoran',
                'Rp ' . number_format(
                    $this->record->depositTransactions()->sum('total_amount'),
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Total nilai setoran')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make(
                'Total Penarikan',
                $this->record->withdrawalTransactions()->count()
            )
                ->description('Jumlah transaksi penarikan')
                ->descriptionIcon('heroicon-m-arrow-up-circle')
                ->color('danger'),

            Stat::make(
                'Nominal Penarikan',
                'Rp ' . number_format(
                    $this->record->withdrawalTransactions()->sum('amount'),
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Total nilai penarikan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),
        ];
    }
}
