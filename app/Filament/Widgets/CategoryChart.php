<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class CategoryChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 5;

    protected static ?string $heading = 'Posts by Category';

    protected function getData(): array
    {
        $data = Category::withCount('posts')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Categories',
                    'data' => $data->pluck('posts_count')->toArray(),
                    'backgroundColor' => ['#ef4444', '#f97316', '#eab308', '#22c55e', '#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b', '#84cc16', '#14b8a6', '#6366f1', '#a855f7'],
                    'borderColor' => '#1e40af',
                ],
            ],
            'labels' => $data->pluck('name')->toArray(),
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }
}
