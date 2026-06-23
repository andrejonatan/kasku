<?php

namespace App\Filament\Resources\KategoriTransaksis\Pages;

use App\Filament\Resources\KategoriTransaksis\KategoriTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriTransaksis extends ListRecords
{
    protected static string $resource = KategoriTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('create KategoriTransaksi')
        ? [Actions\CreateAction::make()]
        : [];
    }
}
