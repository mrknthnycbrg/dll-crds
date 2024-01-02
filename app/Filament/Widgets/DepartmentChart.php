<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class DepartmentChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 4;

    protected static ?string $heading = 'Researches by Department';

    protected function getData(): array
    {
        $data = Department::withCount('researches')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Departments',
                    'data' => $data->pluck('researches_count')->toArray(),
                    'backgroundColor' => ['#ef4444', '#f97316', '#eab308', '#22c55e', '#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b', '#84cc16', '#14b8a6', '#6366f1', '#a855f7'],
                    'animation' => [
                        'duration' => 1500
                    ],
                ],
            ],
            'labels' => $data->pluck('name')->toArray(),
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'elements' => [
                'arc' => [
                    'borderWidth' => 0,
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
