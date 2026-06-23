<?php

namespace App\Filament\Resources\Periodes\Pages;

use App\Filament\Resources\Periodes\PeriodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeriodes extends ListRecords
{
    protected static string $resource = PeriodeResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('create Periode')
        ? [Actions\CreateAction::make()]
        : [];
    }
}
