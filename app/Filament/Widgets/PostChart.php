<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class PostChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 3;

    protected static ?string $heading = 'Posts by Date';

    public ?string $filter = 'all';

    protected function getFilters(): ?array
    {
        return [
            'all' => 'All time',
            'year' => 'This year',
            'month' => 'This month',
            'week' => 'This week',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        switch ($activeFilter) {
            case 'all':
                $data = Trend::model(Post::class)
                    ->dateColumn('date_published')
                    ->between(
                        start: Carbon::parse(Post::min('date_published')),
                        end: today(),
                    )
                    ->perMonth()
                    ->count();
                break;
            case 'year':
                $data = Trend::model(Post::class)
                    ->dateColumn('date_published')
                    ->between(
                        start: today()->startOfYear(),
                        end: today()->endOfYear(),
                    )
                    ->perMonth()
                    ->count();
                break;
            case 'month':
                $data = Trend::model(Post::class)
                    ->dateColumn('date_published')
                    ->between(
                        start: today()->startOfMonth(),
                        end: today()->endOfMonth(),
                    )
                    ->perDay()
                    ->count();
                break;
            case 'week':
                $data = Trend::model(Post::class)
                    ->dateColumn('date_published')
                    ->between(
                        start: today()->startOfWeek(0),
                        end: today()->endOfWeek(6),
                    )
                    ->perDay()
                    ->count();
                break;
            default:
                $data = Trend::model(Post::class)
                    ->dateColumn('date_published')
                    ->between(
                        start: Carbon::parse(Post::min('date_published')),
                        end: today(),
                    )
                    ->perMonth()
                    ->count();
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#1e40af',
                    'borderColor' => '#93c5fd',
                    'animation' => [
                        'duration' => 1500,
                    ],
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
