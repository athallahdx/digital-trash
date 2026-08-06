<?php

namespace App\Filament\Resources\Ledgers\Pages;

use App\Filament\Resources\Ledgers\LedgerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Ledgers\Widgets\LedgerRecordOverview;

class ViewLedger extends ViewRecord
{
    protected static string $resource = LedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LedgerRecordOverview::class,
        ];
    }
}
