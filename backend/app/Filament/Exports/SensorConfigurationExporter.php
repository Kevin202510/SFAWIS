<?php

namespace App\Filament\Exports;

use App\Models\SensorConfiguration;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SensorConfigurationExporter extends Exporter
{
    protected static ?string $model = SensorConfiguration::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('configuration_name'),
            ExportColumn::make('logo'),
            ExportColumn::make('description'),
            ExportColumn::make('configuration_value'),
            ExportColumn::make('statusName'),
            ExportColumn::make('createdBy.name'),
            ExportColumn::make('updateBy.name'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your sensor configuration export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
