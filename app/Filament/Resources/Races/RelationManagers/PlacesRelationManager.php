<?php

namespace App\Filament\Resources\Races\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Locality;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PlacesRelationManager extends RelationManager
{
    protected static string $relationship = 'places';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->relationship('province', 'name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($set) => $set('locality_id', null)),
                Select::make('locality_id')
                    ->options(function ($get) {
                        $provinceId = $get('province_id');
                        return $provinceId ? Locality::where('province_id',$provinceId)->pluck('name','id') : [];
                    })
                    ->required(),
                TextInput::make('place')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('place')
            ->columns([
                TextColumn::make('province.name'),
                TextColumn::make('locality.name'),
                TextColumn::make('place'),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
