<?php

namespace App\Filament\Resources\Ledgers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class LedgersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_number')
                    ->label('Nomor Rekening')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('balance')
                    ->label('Saldo')
                    ->money('IDR', decimalPlaces: 0)
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Nomor Telepon')
                    ->searchable(),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn (bool $state) => $state ? 'success' : 'danger'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
