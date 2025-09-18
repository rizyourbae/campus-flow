<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestSchedules;
use App\Filament\Widgets\RoomUsageChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\WelcomeWidget;
use App\Filament\Widgets\RealtimeClockWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            WelcomeWidget::class,      // Widget sambutan
            RealtimeClockWidget::class, // Widget jam baru kita
            StatsOverview::class,
            LatestSchedules::class,
            RoomUsageChart::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }

    public function getWidgetsColumns(): int | string | array
    {
        return [
            // Widget sambutan dan jam akan berbagi tempat, masing-masing 1 kolom
            WelcomeWidget::class => 1,
            RealtimeClockWidget::class => 1,

            // Sisanya akan full-width di bawahnya
            StatsOverview::class => 'full',
            LatestSchedules::class => 'full',
            RoomUsageChart::class => 'full',
        ];
    }
}
