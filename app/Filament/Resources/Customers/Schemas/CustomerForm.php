<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_number')
                    ->label('Nomor Rekening')
                    ->disabled(fn (string $operation) => $operation === 'create')
                    ->dehydrated(fn (string $operation) => $operation !== 'create')
                    ->helperText(fn (string $operation) => $operation === 'create'
                        ?'Nomor rekening akan otomatis dibuat oleh sistem. Anda dapat mengubahnya setelah data berhasil dibuat.': null),
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('balance')
                    ->label('Saldo')
                    ->required()
                    ->prefix('Rp')
                    ->numeric()
                    ->default(0),
                Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel(),
                Toggle::make('is_active')
                    ->label('Status')
                    ->required(),
            ]);
    }
}
