<?php

namespace App\Filament\Resources\DepositTransactions\Pages;

use App\Filament\Resources\DepositTransactions\DepositTransactionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDepositTransaction extends ViewRecord
{
    protected static string $resource = DepositTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
