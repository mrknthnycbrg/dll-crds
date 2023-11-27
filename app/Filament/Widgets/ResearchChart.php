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

    public ?string $filter = 'years';

    protected function getFilters(): ?array
    {
        return [
            'years' => '2020 - Present',
            'year' => 'This year',
            'month' => 'This month',
            'week' => 'This week',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        switch ($activeFilter) {
            case 'years':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfYear()->setYear(2020),
                        end: today(),
                    )
                    ->perMonth()
                    ->count();
                break;
            case 'year':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfYear(),
                        end: today()->endOfYear(),
                    )
                    ->perMonth()
                    ->count();
                break;
            case 'month':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfMonth(),
                        end: today()->endOfMonth(),
                    )
                    ->perDay()
                    ->count();
                break;
            case 'week':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfWeek(0),
                        end: today()->endOfWeek(6),
                    )
                    ->perDay()
                    ->count();
                break;
            default:
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfYear()->setYear(2020),
                        end: today(),
                    )
                    ->perMonth()
                    ->count();
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Researches added',
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
