<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AcademicYear;
use App\Models\Lecturer;
use App\Models\Course;
use App\Models\Room;
use App\Models\StudentGroup;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data master pertama yang ada di database
        // Pastikan data ini ada sebelum menjalankan seeder!
        $activeAcademicYear = AcademicYear::where('is_active', true)->first();
        $lecturer = Lecturer::first();
        $course = Course::first();
        $room = Room::first();
        $studentGroup = StudentGroup::first();

        // Cek jika ada data master yang kosong, hentikan seeder
        if (!$activeAcademicYear || !$lecturer || !$course || !$room || !$studentGroup) {
            $this->command->error('Pastikan data master (Tahun Ajaran Aktif, Dosen, Matkul, Ruangan, Kelas) sudah terisi sebelum menjalankan seeder ini.');
            return;
        }

        // Buat 3 jadwal bohongan
        Schedule::create([
            'academic_year_id' => $activeAcademicYear->id,
            'lecturer_id' => $lecturer->id,
            'course_id' => $course->id,
            'room_id' => $room->id,
            'student_group_id' => $studentGroup->id,
            'day_of_week' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '10:00',
        ]);

        Schedule::create([
            'academic_year_id' => $activeAcademicYear->id,
            'lecturer_id' => $lecturer->id,
            'course_id' => $course->id,
            'room_id' => $room->id,
            'student_group_id' => $studentGroup->id,
            'day_of_week' => 'Rabu',
            'start_time' => '13:00',
            'end_time' => '15:00',
        ]);

        Schedule::create([
            'academic_year_id' => $activeAcademicYear->id,
            'lecturer_id' => Lecturer::latest()->first()->id, // Ambil dosen lain jika ada
            'course_id' => Course::latest()->first()->id, // Ambil matkul lain jika ada
            'room_id' => Room::latest()->first()->id, // Ambil ruangan lain jika ada
            'student_group_id' => $studentGroup->id,
            'day_of_week' => 'Jumat',
            'start_time' => '10:00',
            'end_time' => '12:00',
        ]);
    }
}
