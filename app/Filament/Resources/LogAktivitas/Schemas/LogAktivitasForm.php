<?php

namespace App\Filament\Resources\LogAktivitas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LogAktivitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_user')
                    ->required()
                    ->numeric(),
                TextInput::make('aktivitas')
                    ->required(),
                DateTimePicker::make('waktu_log'),
            ]);
    }
}
