<?php

namespace App\Filament\Widgets;

use App\Models\SoilMoisture;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class SoilMoisureMonitoringChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Soil Moisture Monitoring Chart';
    protected static ?string $pollingInterval = '60s';

    protected function getData(): array
    {
        $startDate = Carbon::parse(data_get($this->filters,'startDate', Carbon::now()));
        $endDate = Carbon::parse(data_get($this->filters,'endDate', Carbon::now()));

        $soilMoistureData = SoilMoisture::limit(20)
            ->orderBy('created_at', 'desc')
            ->whereBetween('created_at',[$startDate->startOfDay(), $endDate->endOfDay()])
            ->get(['created_at', 'soil_moisture'])
            ->reverse();

        return [
            'datasets' => [
                [
                    'label' => 'Soil Moisture (%)',
                    'data' => $soilMoistureData->pluck('soil_moisture')->toArray(),
                    'backgroundColor' => 'rgba(75, 166, 226, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'pointRadius' => 5,
                    'pointHoverRadius' => 7,
                ],
            ],
            'labels' => $soilMoistureData->pluck('created_at')->map(fn($date) => Carbon::parse($date)->format('M d, Y h:i A'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
