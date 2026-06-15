<?php

namespace App\Filament\Resources\KegiatanKelas\Pages;

use App\Filament\Resources\KegiatanKelas\KegiatanKelasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKegiatanKelas extends EditRecord
{
    protected static string $resource = KegiatanKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
