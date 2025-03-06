<?php

namespace App\Filament\Widgets;

use App\Models\Temperature;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class TemperatureMonitoringChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Temperature Monitoring Chart';
    protected static ?string $pollingInterval = '60s';

    protected function getData(): array
    {
        $startDate = Carbon::parse(data_get($this->filters,'startDate', Carbon::now()));
        $endDate = Carbon::parse(data_get($this->filters,'endDate', Carbon::now()));

        $temperatureData = Temperature::limit(20)
        ->orderBy('created_at','desc')
        ->whereBetween('created_at',[$startDate->startOfDay(), $endDate->endOfDay()])
        ->get(['created_at', 'temperature'])
        ->reverse();

        return [
            'datasets' => [
                [
                    'label' => 'Temperature (°C)',
                    'data' => $temperatureData->pluck('temperature')->toArray(), 
                    'backgroundColor' => 'rgba(75, 166, 226, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'pointRadius' => 5,
                    'pointHoverRadius' => 7,
                ],
            ],
            'labels' => $temperatureData->pluck('created_at')->map(fn($date) => Carbon::parse($date)->format('M d, Y h:i A'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
