<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TemperatureResource\Pages;
use App\Filament\Resources\TemperatureResource\RelationManagers;
use App\Models\Temperature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class TemperatureResource extends Resource
{
    protected static ?string $model = Temperature::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Irrigation & Monitoring';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('temperature')
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
                Tables\Columns\TextColumn::make('temperature')
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTemperatures::route('/'),
        ];
    }
}
