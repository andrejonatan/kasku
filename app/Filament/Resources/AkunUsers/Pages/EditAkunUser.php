<?php

namespace App\Filament\Resources\AkunUsers\Pages;

use App\Filament\Resources\AkunUsers\AkunUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAkunUser extends EditRecord
{
    protected static string $resource = AkunUserResource::class;

    protected function getHeaderActions(): array
    {
        return auth()->user()->can('delete AkunUser')
            ? [Actions\DeleteAction::make()]
            : [];
    }
}