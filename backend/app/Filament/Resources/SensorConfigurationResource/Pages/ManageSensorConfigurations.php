<?php

namespace App\Filament\Resources\SensorConfigurationResource\Pages;

use App\Filament\Resources\SensorConfigurationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSensorConfigurations extends ManageRecords
{
    protected static string $resource = SensorConfigurationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
