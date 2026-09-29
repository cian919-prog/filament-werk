<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\QueryBuilder\Constraints\BooleanConstraint;
use Filament\QueryBuilder\Constraints\DateConstraint;
use Filament\QueryBuilder\Constraints\TextConstraint;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\UnitEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Gebruikers';

    protected static ?string $modelLabel = 'gebruiker';

    protected static ?string $pluralModelLabel = 'gebruikers';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Naam')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('E-mail')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            TextInput::make('password')
                ->label('Wachtwoord')
                ->password()
                ->revealable()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->minLength(8)
                ->dehydrated(fn ($state): bool => filled($state)),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('name')
                    ->label('Naam')
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false),

                TextColumn::make('email_verified_at')
                    ->label('E-mail geverifieerd')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Aangemaakt')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Gewijzigd')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                QueryBuilder::make()
                    ->label('Geavanceerd filter')
                    ->constraints([
                        TextConstraint::make('name'),
                        TextConstraint::make('email'),
                        BooleanConstraint::make('email_verified_at'),
                        DateConstraint::make('created_at'),
                    ])
                    ->maxRules(20)
                    ->maxNestingDepth(5),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Wijzigen'),
                DeleteAction::make()
                    ->label('Verwijderen'),
            ])
            ->toolbarActions([
                CreateAction::make()
                    ->label('Gebruiker aanmaken')
                    ->modalHeading('Nieuwe gebruiker')
                    ->form([
                        TextInput::make('name')
                            ->label('Naam')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->unique(table: 'users', column: 'email')
                            ->maxLength(255),

                        TextInput::make('password')
                            ->label('Wachtwoord')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minLength(8),
                    ]),

                DeleteBulkAction::make()
                    ->label('Geselecteerde verwijderen'),
            ])
            ->reorderableColumns()
            ->deferColumnManager(false)
            ->persistColumnSearchesInSession()
            ->defaultSort('created_at', 'desc');
    }
}
