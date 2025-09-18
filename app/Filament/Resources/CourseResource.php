<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\{Section, Select, TextInput};
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\{EditAction, DeleteAction};
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\{TextColumn};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Manajemen Akademik';
    public static function getPluralModelLabel(): string
    {
        return ('Mata Kuliah');
    }
    protected static ?string $modelLabel = 'Mata Kuliah';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('study_program_id')
                        ->label('Program Studi')
                        ->relationship('studyProgram', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('name')
                        ->label('Nama Mata Kuliah')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('code')
                        ->label('Kode MatKul')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    TextInput::make('credits')
                        ->label('SKS')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(6),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Mata Kuliah')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Course $record): string => $record->code), // Kode Matkul sbg deskripsi
                TextColumn::make('studyProgram.name')
                    ->label('Program Studi')
                    ->sortable(),
                TextColumn::make('credits')
                    ->label('SKS')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('study_program_id')
                    ->label('Filter Prodi')
                    ->relationship('studyProgram', 'name')
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
