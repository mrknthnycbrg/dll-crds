<?php

namespace App\Filament\Widgets;

use App\Models\Research;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ResearchChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Researches';

    protected function getData(): array
    {
        $data = Trend::model(Research::class)
            ->dateColumn('date_submitted')
            ->between(
                start: now()->startOfYear()->subYears(3),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Researches',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
