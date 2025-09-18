<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudyProgramResource\Pages;
use App\Filament\Resources\StudyProgramResource\RelationManagers;
use App\Models\StudyProgram;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\{Section, TextInput};
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\{EditAction, DeleteAction};
use Filament\Tables\Columns\{TextColumn};
use Illuminate\Database\Eloquent\Builder;

class StudyProgramResource extends Resource
{
    protected static ?string $model = StudyProgram::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-library'; // Icon
    protected static ?string $navigationGroup = 'Manajemen Akademik'; // Grouping di sidebar
    public static function getPluralModelLabel(): string
    {
        return ('Program Studi');
    }
    protected static ?string $modelLabel = 'Program Studi';
    protected static ?int $navigationSort = 2; // Urutan di sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Prodi')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('code')
                            ->label('Kode Prodi')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Prodi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->label('Kode Prodi')
                    ->searchable(),
                // Menampilkan jumlah dosen terkait, keren kan!
                TextColumn::make('lecturers_count')
                    ->label('Jumlah Dosen')
                    ->counts('lecturers')
                    ->sortable(),
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
            'index' => Pages\ListStudyPrograms::route('/'),
            'create' => Pages\CreateStudyProgram::route('/create'),
            'edit' => Pages\EditStudyProgram::route('/{record}/edit'),
        ];
    }
}
