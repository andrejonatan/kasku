<?php

namespace App\Filament\Resources\AkunUsers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AkunUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('username')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->label('Password'),
                Select::make('role')
                    ->options(['Admin' => 'Admin', 'Bendahara' => 'Bendahara', 'Anggota' => 'Anggota'])
                    ->required(),
                TextInput::make('nim')
                    ->required(),
                TextInput::make('nama_user')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->options(['L' => 'L', 'P' => 'P'])
                    ->required(),
                TextInput::make('no_hp')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Select::make('id_jabatan')
                    ->relationship('jabatan', 'nama_jabatan')
                    ->required()
                    ->label('Jabatan'),
                    ]);
    }
}
