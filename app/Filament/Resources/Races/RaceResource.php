<?php

namespace App\Filament\Resources\Races;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use App\Filament\Resources\Races\Pages\ListRaces;
use App\Filament\Resources\Races\Pages\CreateRace;
use App\Filament\Resources\Races\Pages\EditRace;
use App\Filament\Resources\RaceResource\Pages;
use App\Filament\Resources\Races\RelationManagers\EditionsRelationManager;
use App\Filament\Resources\Races\RelationManagers\LinksRelationManager;
use App\Filament\Resources\Races\RelationManagers\PlacesRelationManager;
use App\Models\Race;
use App\Tables\Columns\Links;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RaceResource extends Resource
{
    protected static ?string $model = Race::class;

    protected static ?string $navigationLabel = 'Carreras';

    protected static ?string $label = 'Carrera';

    protected static ?string $pluralLabel = 'Carreras';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                ImageColumn::make('image')
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
            ->recordActions([
                EditAction::make(),
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
            'index' => ListRaces::route('/'),
            'create' => CreateRace::route('/create'),
            'edit' => EditRace::route('/{record}/edit'),
        ];
    }
}
