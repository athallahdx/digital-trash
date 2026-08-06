<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalAdminOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengurus', User::count())
                ->descriptionIcon('heroicon-m-user-group')
                ->description('Jumlah seluruh pengurus')
                ->color('info'),
        ];
    }
}