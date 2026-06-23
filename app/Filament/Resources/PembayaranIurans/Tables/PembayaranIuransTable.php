<?php

namespace App\Filament\Resources\PembayaranIurans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PembayaranIuransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id_pembayaran')
                //     ->sortable(),

                TextColumn::make('user.nama_user')
                    ->sortable()
                    ->label('Nama User'),

                TextColumn::make('jenisIuran.nama_iuran')
                    ->sortable()
                    ->label('Nama Iuran'),

                TextColumn::make('periode.bulan')
                    ->sortable()
                    ->label('Bulan'),

                TextColumn::make('tanggal_bayar')
                    ->date(),

                TextColumn::make('jumlah_bayar')
                    ->money('IDR'),

                TextColumn::make('status_bayar')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn () => auth()->user()->can('update PembayaranIuran')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->can('delete PembayaranIuran')),
                ]),
            ]);
    }
}
