<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LecturerResource\Pages;
use App\Filament\Resources\LecturerResource\RelationManagers;
use App\Models\Lecturer;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\{Section, TextInput, Select};
use Filament\Tables\Actions\{EditAction, DeleteAction};
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn};
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LecturerResource extends Resource
{
    protected static ?string $model = Lecturer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen Akademik';
    public static function getPluralModelLabel(): string
    {
        return ('Dosen');
    }
    protected static ?string $modelLabel = 'Dosen';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Dosen')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('nip')
                        ->label('NIP')
                        ->required()
                        ->unique(ignoreRecord: true),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    // Select dengan data dari relasi, ini kuncinya!
                    Select::make('study_program_id')
                        ->label('Program Studi')
                        ->relationship('studyProgram', 'name')
                        ->searchable()
                        ->preload() // Langsung load data saat halaman dibuka
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Dosen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nip')
                    ->searchable(),
                // Menampilkan nama prodi dari relasi
                TextColumn::make('studyProgram.name')
                    ->label('Program Studi')
                    ->sortable(),
            ])
            ->filters([
                // Filter berdasarkan Program Studi
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
            'index' => Pages\ListLecturers::route('/'),
            'create' => Pages\CreateLecturer::route('/create'),
            'edit' => Pages\EditLecturer::route('/{record}/edit'),
        ];
    }
}
