<?php

namespace App\Filament\Resources\LogAktivitas\Pages;

use App\Filament\Resources\LogAktivitas\LogAktivitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogAktivitas extends ListRecords
{
    protected static string $resource = LogAktivitasResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('create LogAktivitas')
        ? [Actions\CreateAction::make()]
        : [];
    }
}
