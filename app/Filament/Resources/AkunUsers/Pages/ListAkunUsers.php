<?php

namespace App\Filament\Resources\AkunUsers\Pages;

use App\Filament\Resources\AkunUsers\AkunUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAkunUsers extends ListRecords
{
    protected static string $resource = AkunUserResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('create AkunUser')
            ? [
                Actions\CreateAction::make(),
            ]
            : [];
    }
}