<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ScheduleResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestSchedules extends BaseWidget
{
    protected static ?int $sort = 2; // Urutan widget di dashboard
    public static function getPluralModelLabel(): string
    {
        return ('Jadwal Terbaru');
    }
    protected int | string | array $columnSpan = 'full'; // Biar widget ini full width

    public function table(Table $table): Table
    {
        return $table
            ->query(ScheduleResource::getEloquentQuery())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('course.name')
                    ->label('Mata Kuliah'),
                Tables\Columns\TextColumn::make('lecturer.name')
                    ->label('Dosen'),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Hari')
                    ->badge(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Jam Mulai')
                    ->time('H:i'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat Detail')
                    ->url(fn($record): string => ScheduleResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
