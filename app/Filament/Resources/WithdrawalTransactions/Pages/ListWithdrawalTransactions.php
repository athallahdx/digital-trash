<?php

namespace App\Filament\Resources\WithdrawalTransactions\Pages;

use App\Filament\Resources\WithdrawalTransactions\Widgets\WithdrawalOverview;
use App\Filament\Resources\WithdrawalTransactions\WithdrawalTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWithdrawalTransactions extends ListRecords
{
    protected static string $resource = WithdrawalTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            WithdrawalOverview::class,
        ];
    }
}
