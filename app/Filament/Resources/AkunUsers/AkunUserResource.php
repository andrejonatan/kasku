<?php

namespace App\Filament\Resources\AkunUsers;

use App\Filament\Resources\AkunUsers\Pages\CreateAkunUser;
use App\Filament\Resources\AkunUsers\Pages\EditAkunUser;
use App\Filament\Resources\AkunUsers\Pages\ListAkunUsers;
use App\Filament\Resources\AkunUsers\Schemas\AkunUserForm;
use App\Filament\Resources\AkunUsers\Tables\AkunUsersTable;
use App\Filament\Resources\BaseResource;
use App\Models\AkunUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AkunUserResource extends BaseResource
{
    protected static ?string $model = AkunUser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_user';

    public static function form(Schema $schema): Schema
    {
        return AkunUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AkunUsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAkunUsers::route('/'),
            'create' => CreateAkunUser::route('/create'),
            'edit' => EditAkunUser::route('/{record}/edit'),
        ];
    }
}
