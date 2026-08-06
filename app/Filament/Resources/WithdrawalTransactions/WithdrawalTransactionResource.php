<?php

namespace App\Filament\Resources\WithdrawalTransactions;

use App\Filament\Resources\WithdrawalTransactions\Pages\CreateWithdrawalTransaction;
use App\Filament\Resources\WithdrawalTransactions\Pages\EditWithdrawalTransaction;
use App\Filament\Resources\WithdrawalTransactions\Pages\ListWithdrawalTransactions;
use App\Filament\Resources\WithdrawalTransactions\Pages\ViewWithdrawalTransaction;
use App\Filament\Resources\WithdrawalTransactions\Schemas\WithdrawalTransactionForm;
use App\Filament\Resources\WithdrawalTransactions\Schemas\WithdrawalTransactionInfolist;
use App\Filament\Resources\WithdrawalTransactions\Tables\WithdrawalTransactionsTable;
use App\Models\WithdrawalTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WithdrawalTransactionResource extends Resource
{
    protected static ?string $model = WithdrawalTransaction::class;

    protected static ?string $navigationLabel = 'Riwayat Penarikan';

    protected static ?string $pluralModelLabel = 'Riwayat Penarikan';

    protected static ?string $modelLabel = 'Penarikan';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'transaction_number';

    public static function form(Schema $schema): Schema
    {
        return WithdrawalTransactionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WithdrawalTransactionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WithdrawalTransactionsTable::configure($table);
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
            'index' => ListWithdrawalTransactions::route('/'),
            'create' => CreateWithdrawalTransaction::route('/create'),
            'view' => ViewWithdrawalTransaction::route('/{record}'),
            'edit' => EditWithdrawalTransaction::route('/{record}/edit'),
        ];
    }
}
