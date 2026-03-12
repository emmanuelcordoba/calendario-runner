<?php

namespace App\Filament\Resources\Races\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Models\Edition;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class EditionsRelationManager extends RelationManager
{
    protected static string $relationship = 'editions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('start_date')
                    ->required()
                    ->default(function () {
                        $race = $this->getRelationship()->getParent();
                        if ($race) {
                            $lastEdition = $race->editions()->latest('created_at')->first();
                            return $lastEdition ? $lastEdition->start_date->addYear() : now();
                        }
                        return now();
                    }),
                DatePicker::make('end_date')
                    ->required()
                    ->default(function () {
                        $race = $this->getRelationship()->getParent();
                        if ($race) {
                            $lastEdition = $race->editions()->latest('created_at')->first();
                            return $lastEdition ? $lastEdition->end_date->addYear() : now();
                        }
                        return now();
                    }),
                Repeater::make('distances')
                    ->label('Distancias')
                    ->simple(
                        TextInput::make('value')
                            ->label('Distancia')
                            ->maxLength(255)
                            ->required()
                    )
                    ->default(function () {
                        $race = $this->getRelationship()->getParent();
                        if ($race) {
                            $lastEdition = $race->editions()->latest('created_at')->first();
                            if ($lastEdition && $lastEdition->distances) {
                                return collect($lastEdition->distances)
                                    ->map(fn ($d) => is_array($d) ? ($d['value'] ?? '') : $d)
                                    ->values()
                                    ->all();
                            }
                        }
                        return [''];
                    })
                    ->required(),
                TextInput::make('image')
                    ->maxLength(255)
                    ->url(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('year')
            ->columns([
                TextColumn::make('start_date')->date(),
                TextColumn::make('end_date')->date(),
                TextColumn::make('distances')
                    ->formatStateUsing(fn ($state) => is_array($state)
                        ? implode(', ', array_map(fn ($d) => is_array($d) ? ($d['value'] ?? '') : $d, $state))
                        : $state
                    ),
                ImageColumn::make('image'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
