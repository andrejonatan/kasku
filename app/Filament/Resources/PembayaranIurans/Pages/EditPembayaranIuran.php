<?php

namespace App\Filament\Resources\PembayaranIurans\Pages;

use App\Filament\Resources\PembayaranIurans\PembayaranIuranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembayaranIuran extends EditRecord
{
    protected static string $resource = PembayaranIuranResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('delete PembayaranIuran')
        ? [Actions\DeleteAction::make()]
        : [];
    }
}
