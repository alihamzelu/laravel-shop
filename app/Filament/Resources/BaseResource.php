<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;

abstract class BaseResource extends Resource
{
    protected static string $permissionPrefix = '';

    protected static function isSuperAdmin(): bool
    {
        return auth()->check() && auth()->user()->hasRole('super-admin');
    }

    protected static function canPermission(string $action): bool
    {
        if (! auth()->check()) {
            return false;
        }

        if (static::isSuperAdmin()) {
            return true;
        }

        return auth()->user()->can(static::$permissionPrefix . '.' . $action);
    }

    public static function canViewAny(): bool
    {
        return static::canPermission('view');
    }

    public static function canCreate(): bool
    {
        return static::canPermission('create');
    }

    public static function canEdit($record): bool
    {
        return static::canPermission('edit');
    }

    public static function canDelete($record): bool
    {
        return static::canPermission('delete');
    }
}