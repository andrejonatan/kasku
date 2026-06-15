<?php

namespace App\Filament\Resources\KegiatanKelas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class KegiatanKelasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_kegiatan')
                    ->sortable(),

                TextColumn::make('nama_kegiatan')
                    ->searchable(),

                TextColumn::make('tanggal_mulai')
                    ->date(),

                TextColumn::make('tanggal_selesai')
                    ->date(),
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
