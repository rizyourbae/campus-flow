<?php

namespace App\Filament\Resources\StudentGroupResource\Pages;

use App\Filament\Resources\StudentGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentGroups extends ListRecords
{
    protected static string $resource = StudentGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalWidth('md')
                ->icon('bi-plus-square-fill'),
        ];
    }
}
