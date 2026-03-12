<?php

namespace App\Filament\Resources\Localities;

use Filament\Schemas\Schema;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\Localities\Pages\ManageLocalities;
use App\Filament\Resources\LocalityResource\Pages;
use App\Models\Locality;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LocalityResource extends Resource
{
    protected static ?string $model = Locality::class;

    protected static ?string $navigationLabel = 'Localidades';

    protected static ?string $label = 'Localidad';

    protected static ?string $pluralLabel = 'Localidades';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->relationship('province', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('province.name')
                    ->sortable()
            ])
            ->filters([
                SelectFilter::make('province_id')
                    ->relationship('province', 'name')
                    ->label('Provincia')
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLocalities::route('/'),
        ];
    }
}
