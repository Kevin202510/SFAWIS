<?php

namespace App\Filament\Resources\SensorControlResource\Pages;

use App\Filament\Resources\SensorControlResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSensorControls extends ManageRecords
{
    protected static string $resource = SensorControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
