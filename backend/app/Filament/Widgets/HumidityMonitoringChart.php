<?php

namespace App\Filament\Widgets;

use App\Models\Humidity;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class HumidityMonitoringChart extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Humidity Monitoring Chart';
    protected static ?string $pollingInterval = '60s';

    protected function getData(): array
    {
        $startDate = Carbon::parse(data_get($this->filters,'startDate', Carbon::now()));
        $endDate = Carbon::parse(data_get($this->filters,'endDate', Carbon::now()));

        $humidityData = Humidity::limit(20)
            ->orderBy('created_at', 'desc')
            ->whereBetween('created_at',[$startDate->startOfDay(), $endDate->endOfDay()])
            ->get(['created_at', 'humidity'])
            ->reverse();

        return [
            'datasets' => [
                [
                    'label' => 'Humidity (%)',
                    'data' => $humidityData->pluck('humidity')->toArray(),
                    'backgroundColor' => 'rgba(75, 166, 226, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'pointRadius' => 5,
                    'pointHoverRadius' => 7,
                ],
            ],
            'labels' => $humidityData->pluck('created_at')->map(fn($date) => Carbon::parse($date)->format('M d, Y h:i A'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
