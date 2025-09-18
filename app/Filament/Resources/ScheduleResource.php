<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\StudentGroup;
use Filament\Forms\Components\{Section, Select, TimePicker};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\{EditAction, DeleteAction, ViewAction};
use Filament\Tables\Columns\{TextColumn};
use Filament\Tables\Grouping\Group;
use Filament\Forms\Get;
use Filament\Infolists\Infolist; // <-- Import Infolist
use Filament\Infolists\Components\Grid; // <-- Import komponen Infolist
use Filament\Infolists\Components\TextEntry;
use App\Exports\SchedulesExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    public static function getPluralModelLabel(): string
    {
        return ('Jadwal Kuliah');
    }
    protected static ?string $modelLabel = 'Jadwal Kuliah';
    protected static ?int $navigationSort = 0; // Taruh paling atas

    public static function form(Form $form): Form
    {
        $activeAcademicYear = AcademicYear::where('is_active', true)->first();

        return $form
            ->schema([
                Section::make('Detail Jadwal')->schema([
                    Select::make('academic_year_id')
                        ->label('Tahun Ajaran')
                        ->options(AcademicYear::orderBy('year', 'desc')->get()->mapWithKeys(fn($y) => [$y->id => "{$y->year} - {$y->semester}"]))
                        ->default($activeAcademicYear?->id)
                        ->required(),
                    Select::make('student_group_id')
                        ->label('Kelas')
                        ->options(StudentGroup::all()
                            ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('course_id')
                        ->label('Mata Kuliah')
                        ->options(Course::all()
                            ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('lecturer_id')
                        ->label('Dosen')
                        ->options(Lecturer::all()
                            ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('room_id')
                        ->label('Ruangan')
                        ->options(Room::all()
                            ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('day_of_week')
                        ->label('Hari')
                        ->options(
                            [
                                'Senin' => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu'
                            ]
                        )
                        ->required(),
                    TimePicker::make('start_time')
                        ->label('Jam Mulai')
                        ->seconds(false)
                        ->required(),
                    TimePicker::make('end_time')
                        ->label('Jam Selesai')
                        ->seconds(false)
                        ->required()
                        ->after('start_time') // Validasi ini jalan setelah Jam Mulai diisi
                        ->rules([
                            fn(Get $get): \Closure => function (string $attribute, $value, \Closure $fail) use ($get) {
                                $startTime = Carbon::parse($get('start_time'));
                                $endTime = Carbon::parse($value);

                                if ($startTime->gte($endTime)) {
                                    $fail('Jam selesai harus setelah jam mulai.');
                                    return;
                                }

                                $recordId = $get('id'); // Dapatkan ID record saat ini (untuk mode edit)

                                // Query untuk cek bentrok
                                $conflict = Schedule::where('day_of_week', $get('day_of_week'))
                                    ->where(function ($query) use ($startTime, $endTime) {
                                        $query->where('start_time', '<', $endTime->format('H:i:s'))
                                            ->where('end_time', '>', $startTime->format('H:i:s'));
                                    })
                                    ->where(function ($query) use ($get) {
                                        $query->where('lecturer_id', $get('lecturer_id'))
                                            ->orWhere('room_id', $get('room_id'))
                                            ->orWhere('student_group_id', $get('student_group_id'));
                                    })
                                    ->when($recordId, fn($query) => $query->where('id', '!=', $recordId)) // Abaikan record ini sendiri saat edit
                                    ->first();

                                if ($conflict) {
                                    $fail("Jadwal bentrok dengan: Matkul {$conflict->course->name} di Ruang {$conflict->room->name}.");
                                }
                            },
                        ]),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // FITUR KEREN: Jadwal dikelompokkan berdasarkan hari!
            ->groups([
                Group::make('day_of_week')
                    ->label('Hari')
                    ->collapsible(), // Bisa di-minimize
            ])
            ->defaultGroup('day_of_week')
            ->columns([
                TextColumn::make('course.name')
                    ->label('Mata Kuliah')
                    ->searchable(),
                TextColumn::make('lecturer.name')
                    ->label('Dosen')
                    ->searchable(),
                TextColumn::make('room.name')
                    ->label('Ruangan'),
                TextColumn::make('studentGroup.name')
                    ->label('Kelas'),
                TextColumn::make('start_time')
                    ->label('Jam Mulai')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('end_time')
                    ->label('Jam Selesai')
                    ->time('H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Jadwal Kuliah')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->label('Export ke Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(fn() => Excel::download(new SchedulesExport, 'jadwal-kuliah.xlsx'))
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Informasi Jadwal Perkuliahan')->schema([
                Grid::make(3)->schema([
                    // Grup Kiri: Informasi Utama
                    Group::make()->schema([
                        TextEntry::make('course.name')
                            ->label('Mata Kuliah')
                            ->icon('heroicon-o-book-open'),
                        TextEntry::make('lecturer.name')
                            ->label('Dosen Pengajar')
                            ->icon('heroicon-o-user'),
                        TextEntry::make('studentGroup.name')
                            ->label('Kelas')
                            ->icon('heroicon-o-user-group'),
                    ])->columnSpan(2),

                    // Grup Kanan: Informasi Waktu & Tempat
                    Group::make()->schema([
                        TextEntry::make('day_of_week')
                            ->label('Hari')
                            ->badge()
                            ->color('success'),
                        TextEntry::make('start_time')
                            ->label('Jam Mulai')
                            ->time('H:i')
                            ->icon('heroicon-o-clock'),
                        TextEntry::make('end_time')
                            ->label('Jam Selesai')
                            ->time('H:i')
                            ->icon('heroicon-o-clock'),
                        TextEntry::make('room.name')
                            ->label('Ruangan')
                            ->icon('heroicon-o-map-pin'),
                    ])->columnSpan(1),
                ])
            ])
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'view' => Pages\ViewSchedule::route('/{record}'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
