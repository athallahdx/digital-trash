<?php

namespace App\Filament\Resources\WithdrawalTransactions\Pages;

use App\Filament\Resources\WithdrawalTransactions\WithdrawalTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWithdrawalTransaction extends EditRecord
{
    protected static string $resource = WithdrawalTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
