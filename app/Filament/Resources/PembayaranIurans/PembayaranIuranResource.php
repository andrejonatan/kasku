<?php

namespace App\Filament\Resources\PembayaranIurans;

use App\Filament\Resources\PembayaranIurans\Pages\CreatePembayaranIuran;
use App\Filament\Resources\PembayaranIurans\Pages\EditPembayaranIuran;
use App\Filament\Resources\PembayaranIurans\Pages\ListPembayaranIurans;
use App\Filament\Resources\PembayaranIurans\Schemas\PembayaranIuranForm;
use App\Filament\Resources\PembayaranIurans\Tables\PembayaranIuransTable;
use App\Models\PembayaranIuran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PembayaranIuranResource extends Resource
{
    protected static ?string $model = PembayaranIuran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id_pembayaran';

    public static function form(Schema $schema): Schema
    {
        return PembayaranIuranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PembayaranIuransTable::configure($table);
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
            'index' => ListPembayaranIurans::route('/'),
            'create' => CreatePembayaranIuran::route('/create'),
            'edit' => EditPembayaranIuran::route('/{record}/edit'),
        ];
    }
}
