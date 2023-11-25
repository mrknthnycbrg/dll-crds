<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PostChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 3;

    protected static ?string $heading = 'Posts';

    protected function getData(): array
    {
        $data = Trend::model(Post::class)
            ->dateColumn('date_published')
            ->between(
                start: now()->startOfYear()->subYears(3),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Posts',
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
