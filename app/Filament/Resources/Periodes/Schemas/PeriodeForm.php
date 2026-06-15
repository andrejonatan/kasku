<?php

namespace App\Filament\Resources\Periodes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class PeriodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bulan')
            ->required(),
                TextInput::make('tahun')
                    ->numeric()
                    ->required(),
                ]);
    }
}
