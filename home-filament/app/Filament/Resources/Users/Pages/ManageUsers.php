<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        // Because the resource has no "create" page, this button opens a modal
        // that uses the resource's form (UserForm).
        return [
            CreateAction::make(),
        ];
    }
}
