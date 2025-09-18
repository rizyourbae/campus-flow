<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicYearResource\Pages;
use App\Filament\Resources\AcademicYearResource\RelationManagers;
use App\Models\AcademicYear;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\{Section, Select, TextInput, Toggle};
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\{EditAction, DeleteAction};
use Filament\Tables\Columns\{TextColumn};
use Illuminate\Database\Eloquent\Builder;

class AcademicYearResource extends Resource
{
    protected static ?string $model = AcademicYear::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Manajemen Akademik';
    public static function getPluralModelLabel(): string
    {
        return ('Tahun Ajaran');
    }
    protected static ?string $modelLabel = 'Tahun Ajaran';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('year')
                        ->label('Tahun')
                        ->placeholder('Contoh: 2025/2026')
                        ->required()
                        ->maxLength(255),
                    Select::make('semester')
                        ->options([
                            'Ganjil' => 'Ganjil',
                            'Genap' => 'Genap',
                        ])
                        ->required(),
                    // Toggle lebih modern daripada checkbox
                    Toggle::make('is_active')
                        ->label('Status Aktif')
                        ->helperText('Hanya boleh ada satu tahun ajaran yang aktif.'),
                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('year')
                    ->label('Tahun')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('semester')
                    ->sortable(),
                // BadgeColumn bikin statusnya lebih eye-catching
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge() // Tinggal tambahin ini
                    ->formatStateUsing(fn(bool $state): string => $state ? 'Aktif' : 'Non-Aktif')
                    ->color(fn(bool $state): string => $state ? 'success' : 'danger'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicYears::route('/'),
            'create' => Pages\CreateAcademicYear::route('/create'),
            'edit' => Pages\EditAcademicYear::route('/{record}/edit'),
        ];
    }
}
