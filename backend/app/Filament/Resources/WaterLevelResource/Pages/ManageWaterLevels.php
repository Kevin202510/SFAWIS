<?php

namespace App\Filament\Resources\WaterLevelResource\Pages;

use App\Filament\Resources\WaterLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWaterLevels extends ManageRecords
{
    protected static string $resource = WaterLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
