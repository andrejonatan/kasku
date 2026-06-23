<?php

namespace App\Filament\Resources\Periodes\Pages;

use App\Filament\Resources\Periodes\PeriodeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeriode extends EditRecord
{
    protected static string $resource = PeriodeResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('delete Periode')
        ? [Actions\DeleteAction::make()]
        : [];
    }
}
