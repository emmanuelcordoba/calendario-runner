<?php

namespace App\Filament\Resources\Localities\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Localities\LocalityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLocalities extends ManageRecords
{
    protected static string $resource = LocalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
