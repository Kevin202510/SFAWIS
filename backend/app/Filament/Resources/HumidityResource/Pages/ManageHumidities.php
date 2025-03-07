<?php

namespace App\Filament\Resources\HumidityResource\Pages;

use App\Filament\Resources\HumidityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHumidities extends ManageRecords
{
    protected static string $resource = HumidityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
