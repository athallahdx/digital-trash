<?php

namespace App\Filament\Resources\WithdrawalTransactions\Pages;

use App\Filament\Resources\WithdrawalTransactions\WithdrawalTransactionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWithdrawalTransaction extends ViewRecord
{
    protected static string $resource = WithdrawalTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
