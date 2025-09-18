<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentGroupResource\Pages;
use App\Filament\Resources\StudentGroupResource\RelationManagers;
use App\Models\StudentGroup;
use Filament\Forms\Form;
use Filament\Forms\Components\{Section, Select, TextInput};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\{EditAction, DeleteAction};
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\{TextColumn};
use Illuminate\Database\Eloquent\Builder;

class StudentGroupResource extends Resource
{
    protected static ?string $model = StudentGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Manajemen Akademik';
    public static function getPluralModelLabel(): string
    {
        return ('Kelas');
    }
    protected static ?string $modelLabel = 'Kelas';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Kelas')
                        ->helperText('Contoh: Kelas Pagi A - TI 2023')
                        ->required()
                        ->maxLength(255),
                    Select::make('study_program_id')
                        ->label('Program Studi')
                        ->relationship('studyProgram', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('academic_year_id')
                        ->label('Tahun Ajaran')
                        // Menampilkan gabungan tahun dan semester
                        ->relationship('academicYear', 'year', modifyQueryUsing: fn($query) => $query->orderBy('year', 'desc'))
                        ->getOptionLabelFromRecordUsing(fn($record) => "{$record->year} - {$record->semester}")
                        ->searchable()
                        ->preload()
                        ->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kelas')
                    ->searchable(),
                TextColumn::make('studyProgram.name')
                    ->label('Program Studi')
                    ->sortable(),
                // Menampilkan relasi Tahun Ajaran dengan format custom
                TextColumn::make('academicYear.year')
                    ->label('Tahun Ajaran')
                    ->formatStateUsing(fn($state, StudentGroup $record) => "{$state} - {$record->academicYear->semester}")
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('study_program_id')
                    ->label('Filter Prodi')
                    ->relationship('studyProgram', 'name'),
                SelectFilter::make('academic_year_id')
                    ->label('Filter T.A.')
                    ->relationship('academicYear', 'year'),
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
            'index' => Pages\ListStudentGroups::route('/'),
            'create' => Pages\CreateStudentGroup::route('/create'),
            'edit' => Pages\EditStudentGroup::route('/{record}/edit'),
        ];
    }
}
