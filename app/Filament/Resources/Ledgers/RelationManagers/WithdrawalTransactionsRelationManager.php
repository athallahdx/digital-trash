<?php

namespace App\Filament\Resources\Ledgers\RelationManagers;

use App\Filament\Resources\WithdrawalTransactions\Schemas\WithdrawalTransactionForm;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class WithdrawalTransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'withdrawalTransactions';

    protected static ?string $title = 'Riwayat Penarikan';

    public function form(Schema $schema): Schema
    {
        return WithdrawalTransactionForm::configure($schema)
            ->components([
                // Override the schema without customer_id
                \Filament\Forms\Components\TextInput::make('transaction_number')
                    ->label('Nomor Transaksi')
                    ->disabled(fn (string $operation) => $operation === 'create')
                    ->dehydrated(fn (string $operation) => $operation !== 'create')
                    ->helperText(fn (string $operation) => $operation === 'create'
                        ? 'Nomor transaksi akan otomatis dibuat oleh sistem. Anda dapat mengubahnya setelah data berhasil dibuat.'
                        : null)
                    ->placeholder('-'),

                \Filament\Forms\Components\DatePicker::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->required(),

                \Filament\Forms\Components\TextInput::make('amount')
                    ->label('Jumlah Penarikan')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->required(),

                \Filament\Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction_number')
                    ->label('Nomor Transaksi')
                    ->searchable(),

                TextColumn::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->date()
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('Jumlah Penarikan')
                    ->money('IDR', decimalPlaces: 0)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dicatat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Catat Penarikan'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}