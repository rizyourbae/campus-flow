<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SchedulesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data jadwal dengan relasinya biar efisien
        return Schedule::with(['course', 'lecturer', 'room', 'studentGroup', 'academicYear'])->get();
    }

    /**
     * Method ini untuk menentukan judul kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'Tahun Ajaran',
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
            'Mata Kuliah',
            'Dosen Pengajar',
            'Ruangan',
            'Kelas',
        ];
    }

    /**
     * Method ini untuk memetakan setiap baris data jadwal ke format yang kita inginkan.
     */
    public function map($schedule): array
    {
        return [
            "{$schedule->academicYear->year} - {$schedule->academicYear->semester}",
            $schedule->day_of_week,
            $schedule->start_time,
            $schedule->end_time,
            $schedule->course->name,
            $schedule->lecturer->name,
            $schedule->room->name,
            $schedule->studentGroup->name,
        ];
    }
}
