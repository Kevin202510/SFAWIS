<?php

namespace App\Filament\Resources\SoilMoistureResource\Pages;

use App\Filament\Resources\SoilMoistureResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSoilMoistures extends ManageRecords
{
    protected static string $resource = SoilMoistureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
