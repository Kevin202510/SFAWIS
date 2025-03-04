<?php

namespace App\Filament\Widgets;

use App\Models\WaterLevel;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class WaterLevelMonitoringChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Water Level Monitoring Chart';
    protected static ?string $pollingInterval = '15s';

    protected function getData(): array
    {
        $startDate = Carbon::parse(data_get($this->filters,'startDate', Carbon::now()));
        $endDate = Carbon::parse(data_get($this->filters,'endDate', Carbon::now()));

        $waterLevelData = WaterLevel::limit(20)
            ->orderBy('created_at', 'desc')
            ->whereBetween('created_at',[$startDate->startOfDay(), $endDate->endOfDay()])
            ->get(['created_at', 'water_level']);

        return [
            'datasets' => [
                [
                    'label' => 'Soil Moisture (%)',
                    'data' => $waterLevelData->pluck('water_level')->toArray(),
                    'backgroundColor' => 'rgba(75, 166, 226, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'pointRadius' => 5,
                    'pointHoverRadius' => 7,
                ],
            ],
            'labels' => $waterLevelData->pluck('created_at')->map(fn($date) => Carbon::parse($date)->format('M d, Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
