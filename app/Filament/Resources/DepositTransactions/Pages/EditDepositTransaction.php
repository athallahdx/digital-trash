<?php

namespace App\Filament\Resources\DepositTransactions\Pages;

use App\Filament\Resources\DepositTransactions\DepositTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDepositTransaction extends EditRecord
{
    protected static string $resource = DepositTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
