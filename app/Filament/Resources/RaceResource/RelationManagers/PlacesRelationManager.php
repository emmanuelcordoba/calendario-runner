<?php

namespace App\Filament\Resources\RaceResource\RelationManagers;

use App\Models\Locality;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PlacesRelationManager extends RelationManager
{
    protected static string $relationship = 'places';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Tables\Columns\TextColumn::make('province.name'),
                Tables\Columns\TextColumn::make('locality.name'),
                Tables\Columns\TextColumn::make('place'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
