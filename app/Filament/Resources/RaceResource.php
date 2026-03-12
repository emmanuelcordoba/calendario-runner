<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaceResource\Pages;
use App\Filament\Resources\RaceResource\RelationManagers\EditionsRelationManager;
use App\Filament\Resources\RaceResource\RelationManagers\LinksRelationManager;
use App\Filament\Resources\RaceResource\RelationManagers\PlacesRelationManager;
use App\Models\Race;
use App\Tables\Columns\Links;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RaceResource extends Resource
{
    protected static ?string $model = Race::class;

    protected static ?string $navigationLabel = 'Carreras';

    protected static ?string $label = 'Carrera';

    protected static ?string $pluralLabel = 'Carreras';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        if(!$get('is_slug_changed_manually') && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->reactive(),
                TextInput::make('slug')
                    ->afterStateUpdated(fn (Set $set) => $set('is_slug_changed_manually', true)),
                Hidden::make('is_slug_changed_manually')
                    ->default(false)
                    ->dehydrated(false),
                Select::make('discipline_id')
                    ->relationship(name: 'discipline', titleAttribute: 'name')
                    ->native(false)
                    ->preload()
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('image')
                    ->maxLength(255)
                    ->url(),
                TextInput::make('place')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen'),
                TextColumn::make('discipline.name')
                    ->searchable(),
                TextColumn::make('final_place')
                    ->label('Lugar')
                    ->searchable(),
                Links::make('links')
                    ->label('Links')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('Próximas carreras')
                    ->url('/admin/carreras/proximamente')
                    ->openUrlInNewTab(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EditionsRelationManager::class,
            LinksRelationManager::class,
            PlacesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRaces::route('/'),
            'create' => Pages\CreateRace::route('/create'),
            'edit' => Pages\EditRace::route('/{record}/edit'),
        ];
    }
}
