<?php

namespace App\Filament\Resources\Customers\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Customer;

class TotalCustomerOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Nasabah', Customer::count())
                ->descriptionIcon('heroicon-m-user-group')
                ->description('Jumlah seluruh nasabah')
                ->color('info'),

            Stat::make('Total Nasabah Aktif', Customer::where('is_active', true)->count())
                ->descriptionIcon('heroicon-m-user-group')
                ->description('Jumlah nasabah yang aktif')
                ->color('success'),

            Stat::make('Total Nasabah Non-Aktif', Customer::where('is_active', false)->count())
                ->descriptionIcon('heroicon-m-user-group')
                ->description('Jumlah nasabah yang non-aktif')
                ->color('danger'),
        ];
    }
}
