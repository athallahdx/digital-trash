<?php

namespace App\Filament\Resources\Ledgers;

use App\Filament\Resources\Ledgers\Pages\CreateLedger;
use App\Filament\Resources\Ledgers\Pages\EditLedger;
use App\Filament\Resources\Ledgers\Pages\ListLedgers;
use App\Filament\Resources\Ledgers\Pages\ViewLedger;
use App\Filament\Resources\Ledgers\Schemas\LedgerForm;
use App\Filament\Resources\Ledgers\Schemas\LedgerInfolist;
use App\Filament\Resources\Ledgers\Tables\LedgersTable;
use App\Models\Customer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LedgerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationLabel = 'Buku Tabungan';

    protected static ?string $pluralModelLabel = 'Buku Tabungan';

    protected static ?string $modelLabel = 'Buku Tabungan';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return LedgerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LedgerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LedgersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DepositTransactionsRelationManager::class,
            RelationManagers\WithdrawalTransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLedgers::route('/'),
            'view' => ViewLedger::route('/{record}'),
            'edit' => EditLedger::route('/{record}/edit'),
        ];
    }
}
