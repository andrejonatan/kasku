<?php

namespace App\Filament\Resources\PembayaranIurans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PembayaranIuranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
    Select::make('id_user')
        ->relationship('user', 'nama_user')
        ->required()
        ->label('Anggota'),

    Select::make('id_iuran')
        ->relationship('jenisIuran', 'nama_iuran')
        ->required()
        ->label('Jenis Iuran'),

    Select::make('id_periode')
        ->relationship('periode', 'bulan')
        ->required()
        ->label('Periode'),

    DatePicker::make('tanggal_bayar')
        ->required(),

    TextInput::make('jumlah_bayar')
        ->numeric()
        ->required(),

    Select::make('status_bayar')
        ->options([
            'Lunas' => 'Lunas',
            'Belum Lunas' => 'Belum Lunas',
        ])
        ->required(),
    ]);
    }
}
