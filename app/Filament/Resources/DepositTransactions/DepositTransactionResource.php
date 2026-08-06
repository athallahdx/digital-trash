<?php

namespace App\Filament\Resources\DepositTransactions;

use App\Filament\Resources\DepositTransactions\Pages\CreateDepositTransaction;
use App\Filament\Resources\DepositTransactions\Pages\EditDepositTransaction;
use App\Filament\Resources\DepositTransactions\Pages\ListDepositTransactions;
use App\Filament\Resources\DepositTransactions\Pages\ViewDepositTransaction;
use App\Filament\Resources\DepositTransactions\Schemas\DepositTransactionForm;
use App\Filament\Resources\DepositTransactions\Schemas\DepositTransactionInfolist;
use App\Filament\Resources\DepositTransactions\Tables\DepositTransactionsTable;
use App\Models\DepositTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DepositTransactionResource extends Resource
{
    protected static ?string $model = DepositTransaction::class;

    protected static ?string $navigationLabel = 'Riwayat Setoran';

    protected static ?string $pluralModelLabel = 'Riwayat Setoran';

    protected static ?string $modelLabel = 'Setoran';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'transaction_number';

    public static function form(Schema $schema): Schema
    {
        return DepositTransactionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DepositTransactionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepositTransactionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDepositTransactions::route('/'),
            'create' => CreateDepositTransaction::route('/create'),
            'view' => ViewDepositTransaction::route('/{record}'),
            'edit' => EditDepositTransaction::route('/{record}/edit'),
        ];
    }
}
