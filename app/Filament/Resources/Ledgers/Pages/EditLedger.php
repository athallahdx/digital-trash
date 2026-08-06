<?php

namespace App\Filament\Resources\Ledgers\Pages;

use App\Filament\Resources\Ledgers\LedgerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Ledgers\Widgets\LedgerRecordOverview;

class EditLedger extends EditRecord
{
    protected static string $resource = LedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LedgerRecordOverview::class,
        ];
    }
}
