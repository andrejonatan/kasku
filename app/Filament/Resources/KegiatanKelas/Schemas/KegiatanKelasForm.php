<?php

namespace App\Filament\Resources\KegiatanKelas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KegiatanKelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_kegiatan')
                    ->required(),

                Textarea::make('deskripsi'),

                DatePicker::make('tanggal_mulai'),

                DatePicker::make('tanggal_selesai'),
            ]);
    }
}
