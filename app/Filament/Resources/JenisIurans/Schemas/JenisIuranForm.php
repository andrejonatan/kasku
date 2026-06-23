<?php

namespace App\Filament\Resources\JenisIurans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class JenisIuranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_iuran')
                    ->required(),

                TextInput::make('nominal')
                    ->numeric()
                    ->required(),

                TextInput::make('keterangan')
                    ->required()
                    ->maxLength(255),
                ]);
    }
}
