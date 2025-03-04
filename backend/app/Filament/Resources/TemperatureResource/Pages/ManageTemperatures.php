<?php

namespace App\Filament\Resources\TemperatureResource\Pages;

use App\Filament\Resources\TemperatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTemperatures extends ManageRecords
{
    protected static string $resource = TemperatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
