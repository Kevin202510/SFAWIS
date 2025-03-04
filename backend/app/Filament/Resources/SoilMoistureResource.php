<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SoilMoistureResource\Pages;
use App\Filament\Resources\SoilMoistureResource\RelationManagers;
use App\Models\SoilMoisture;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class SoilMoistureResource extends Resource
{
    protected static ?string $model = SoilMoisture::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Irrigation & Monitoring';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('soil_moisture')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('soil_moisture')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statusName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                DateRangeFilter::make('created_at')->minDate(now()->startOfYear())->maxDate(now()),
                DateRangeFilter::make('updated_at')->minDate(now()->startOfYear())->maxDate(now()),
            ])
            ->actions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSoilMoistures::route('/'),
        ];
    }
}
