<?php

namespace App\Filament\Resources\KegiatanKelas\Pages;

use App\Filament\Resources\KegiatanKelas\KegiatanKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKegiatanKelas extends ListRecords
{
    protected static string $resource = KegiatanKelasResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('create KegiatanKelas')
        ? [Actions\CreateAction::make()]
        : [];
    }
}
