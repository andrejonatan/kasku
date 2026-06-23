<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseResource extends Resource
{
    protected static function permissionPrefix(): string
    {
        return class_basename(static::getModel());
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can(
            'view-any ' . static::permissionPrefix()
        ) ?? false;
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()?->can(
            'view ' . static::permissionPrefix()
        ) ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can(
            'create ' . static::permissionPrefix()
        ) ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can(
            'update ' . static::permissionPrefix()
        ) ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can(
            'delete ' . static::permissionPrefix()
        ) ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can(
            'delete ' . static::permissionPrefix()
        ) ?? false;
    }

    public static function canForceDelete(Model $record): bool
    {
        return false;
    }

    public static function canForceDeleteAny(): bool
    {
        return false;
    }
}