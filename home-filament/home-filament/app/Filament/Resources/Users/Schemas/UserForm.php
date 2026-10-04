<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label(__('messages.name'))
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label(__('messages.email'))
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            // Required when creating; optional when editing (empty = keep the old password).
            // Hashing is done by the 'hashed' cast on the User model.
            TextInput::make('password')
                ->label(__('messages.password'))
                ->password()
                ->revealable()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->minLength(8)
                ->dehydrated(fn (?string $state): bool => filled($state)),
        ]);
    }
}
