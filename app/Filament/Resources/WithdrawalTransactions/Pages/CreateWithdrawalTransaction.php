<?php

namespace App\Filament\Resources\WithdrawalTransactions\Pages;

use App\Filament\Resources\WithdrawalTransactions\WithdrawalTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWithdrawalTransaction extends CreateRecord
{
    protected static string $resource = WithdrawalTransactionResource::class;
}
