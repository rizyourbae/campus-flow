<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Schedule;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Dosen', Lecturer::count())
                ->description('Jumlah dosen pengajar aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            Stat::make('Total Mata Kuliah', Course::count())
                ->description('Jumlah mata kuliah yang tersedia')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('info'),
            Stat::make('Total Ruangan', Room::count())
                ->description('Jumlah ruangan yang dapat digunakan')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('warning'),
            Stat::make('Total Jadwal Aktif', Schedule::count())
                ->description('Jumlah jadwal yang sudah dibuat')
                ->descriptionIcon('heroicon-m-table-cells')
                ->color('primary'),
        ];
    }
}
