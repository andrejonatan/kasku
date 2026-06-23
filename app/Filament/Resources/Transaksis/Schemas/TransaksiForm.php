<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
            Select::make('id_kategori')
                ->relationship('kategori', 'nama_kategori')
                ->required()
                ->label('Kategori'),

            Select::make('id_user')
                ->relationship('user', 'nama_user')
                ->required()
                ->label('User/Petugas'),

            Select::make('id_kegiatan')
                ->relationship('kegiatan', 'nama_kegiatan')
                ->label('Kegiatan (Opsional)'),

            DatePicker::make('tanggal_transaksi')
                ->required()
                ->label('Tanggal Transaksi'),

            TextInput::make('jumlah')
                ->numeric()
                ->required()
                ->label('Jumlah'),

            Select::make('jenis_transaksi')
                ->options([
                    'Pemasukan' => 'Pemasukan',
                    'Pengeluaran' => 'Pengeluaran',
                ])
                ->required()
                ->label('Jenis Transaksi'),

            TextInput::make('keterangan')
                ->maxLength(255)
                ->label('Keterangan'),
        ]);
    }
}
