<?php

namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_transaksi')
                    ->sortable(),

                TextColumn::make('kategori.nama_kategori')
                    ->sortable()
                    ->label('Kategori'),

                TextColumn::make('tanggal_transaksi')
                    ->date(),

                TextColumn::make('jumlah')
                    ->money('IDR', locale: 'id'),

                TextColumn::make('jenis_transaksi')
                    ->colors([
                        'success' => 'Pemasukan',
                        'danger' => 'Pengeluaran',
                    ]),

                TextColumn::make('keterangan')
                    ->limit(30),
                    ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
