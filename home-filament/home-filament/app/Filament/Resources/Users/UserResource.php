<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ManageUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'name';

    // These are methods (not static properties) so __() is evaluated per request,
    // AFTER the SetLocale middleware has chosen the language.
    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('messages.management');
    }

    public static function getNavigationLabel(): string
    {
        return __('messages.users');
    }

    public static function getModelLabel(): string
    {
        return __('messages.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('messages.users');
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getPages(): array
    {
        // Only an index page: create + edit + delete all happen in modals ("simple resource").
        return [
            'index' => ManageUsers::route('/'),
        ];
    }
}
