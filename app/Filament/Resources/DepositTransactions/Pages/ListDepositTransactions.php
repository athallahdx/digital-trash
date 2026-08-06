<?php

namespace App\Filament\Resources\DepositTransactions\Pages;

use App\Filament\Resources\DepositTransactions\DepositTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DepositTransactions\Widgets\DepositOverview;

class ListDepositTransactions extends ListRecords
{
    protected static string $resource = DepositTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            DepositOverview::class,
        ];
    }
}
