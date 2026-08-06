<?php

namespace App\Filament\Resources\Ledgers\RelationManagers;

use App\Filament\Resources\DepositTransactions\Schemas\DepositTransactionForm;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DepositTransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'depositTransactions';

    protected static ?string $title = 'Riwayat Setoran';

    public function form(Schema $schema): Schema
    {
        return DepositTransactionForm::configure($schema)
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

                \Filament\Forms\Components\TextInput::make('total_amount')
                    ->label('Jumlah Setoran')
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
                TextColumn::make('customer.name')
                    ->label('Nama Nasabah')
                    ->searchable(),
                TextColumn::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->date()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->label('Jumlah Setoran')
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
                    ->label('Catat Setoran'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}