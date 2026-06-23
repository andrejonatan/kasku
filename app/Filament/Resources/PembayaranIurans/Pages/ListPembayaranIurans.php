<?php

namespace App\Filament\Resources\PembayaranIurans\Pages;

use App\Filament\Resources\PembayaranIurans\PembayaranIuranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembayaranIurans extends ListRecords
{
    protected static string $resource = PembayaranIuranResource::class;

    protected function getHeaderActions(): array
    {
    return auth()->user()->can('create PembayaranIuran')
            ? [Actions\CreateAction::make()]
            : [];
    }
}
