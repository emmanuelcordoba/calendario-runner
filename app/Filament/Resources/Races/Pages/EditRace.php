<?php

namespace App\Filament\Resources\Races\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Races\RaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRace extends EditRecord
{
    protected static string $resource = RaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
