<?php

namespace App\Filament\Widgets;

use App\Models\Room;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RoomUsageChart extends ChartWidget
{
    protected static ?string $heading = 'Utilisasi Ruangan';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Room::withCount('schedules')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Jadwal per Ruangan',
                    'data' => $data->pluck('schedules_count')->all(),
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ],
                ],
            ],
            'labels' => $data->pluck('name')->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // Pilihan lain: 'bar', 'line', 'pie', 'polarArea', 'radar'
    }
}
