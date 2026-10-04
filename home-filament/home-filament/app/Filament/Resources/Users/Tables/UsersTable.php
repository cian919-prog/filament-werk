<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\QueryBuilder\Constraints\DateConstraint;
use Filament\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // isIndividual: true  => this column gets its OWN search box
                // isGlobal: false     => it is NOT part of one big search field
                TextColumn::make('name')
                    ->label(__('messages.name'))
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false),

                TextColumn::make('email')
                    ->label(__('messages.email'))
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false),

                // toggleable() => column can be shown/hidden in the column manager
                TextColumn::make('email_verified_at')
                    ->label(__('messages.email_verified_at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(__('messages.created_at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('messages.updated_at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Complex filters: the user builds rules ("name contains X AND created after Y"),
                // can add OR-groups and nest them.
                QueryBuilder::make()
                    ->label(__('messages.advanced_filter'))
                    ->constraints([
                        TextConstraint::make('name')->label(__('messages.name')),
                        TextConstraint::make('email')->label(__('messages.email')),
                        // nullable() adds the operators "is filled" / "is blank"
                        DateConstraint::make('email_verified_at')
                            ->label(__('messages.email_verified_at'))
                            ->nullable(),
                        DateConstraint::make('created_at')->label(__('messages.created_at')),
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            // Drag columns into a different order (in the column manager) ...
            ->reorderableColumns()
            // ... and apply show/hide + order immediately instead of after an "Apply" button.
            ->deferColumnManager(false)
            ->persistColumnSearchesInSession()
            ->defaultSort('created_at', 'desc');
    }
}
