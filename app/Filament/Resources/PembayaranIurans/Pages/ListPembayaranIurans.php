<?php

namespace App\Filament\Resources\PembayaranIurans\Pages;

use App\Filament\Resources\PembayaranIurans\PembayaranIuranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPembayaranIurans extends ListRecords
{
    protected static string $resource = PembayaranIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
