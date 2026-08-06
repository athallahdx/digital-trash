<?php

namespace App\Filament\Resources\DepositTransactions\Pages;

use App\Filament\Resources\DepositTransactions\DepositTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDepositTransaction extends CreateRecord
{
    protected static string $resource = DepositTransactionResource::class;
}
