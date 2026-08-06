<?php

namespace App\Filament\Resources\Ledgers\Pages;

use App\Filament\Resources\Ledgers\LedgerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Ledgers\Widgets\LedgerOverview;

class ListLedgers extends ListRecords
{
    protected static string $resource = LedgerResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            LedgerOverview::class,
        ];
    }
}
