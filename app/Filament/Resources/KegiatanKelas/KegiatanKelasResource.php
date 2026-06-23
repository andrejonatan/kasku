<?php

namespace App\Filament\Resources\KegiatanKelas;

use App\Filament\Resources\KegiatanKelas\Pages\CreateKegiatanKelas;
use App\Filament\Resources\KegiatanKelas\Pages\EditKegiatanKelas;
use App\Filament\Resources\KegiatanKelas\Pages\ListKegiatanKelas;
use App\Filament\Resources\KegiatanKelas\Schemas\KegiatanKelasForm;
use App\Filament\Resources\KegiatanKelas\Tables\KegiatanKelasTable;
use App\Filament\Resources\BaseResource;
use App\Models\KegiatanKelas;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KegiatanKelasResource extends BaseResource
{
    protected static ?string $model = KegiatanKelas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_kegiatan';

    public static function form(Schema $schema): Schema
    {
        return KegiatanKelasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KegiatanKelasTable::configure($table);
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
            'index' => ListKegiatanKelas::route('/'),
            'create' => CreateKegiatanKelas::route('/create'),
            'edit' => EditKegiatanKelas::route('/{record}/edit'),
        ];
    }
}
