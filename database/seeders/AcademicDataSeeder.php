<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\StudyProgram;
use App\Models\AcademicYear;
use App\Models\Room;
use App\Models\Lecturer;
use App\Models\Course;
use App\Models\StudentGroup;
use App\Models\Schedule;

class AcademicDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel sebelum diisi untuk menghindari duplikasi
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schedule::truncate();
        StudentGroup::truncate();
        Course::truncate();
        Lecturer::truncate();
        Room::truncate();
        AcademicYear::truncate();
        StudyProgram::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- Buat Data Master ---

        // 1. Tahun Ajaran
        $activeAcademicYear = AcademicYear::create([
            'year' => '2025/2026',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);

        // 2. Program Studi
        $prodiTI = StudyProgram::create(['name' => 'Teknik Informatika', 'code' => 'TI']);
        $prodiSI = StudyProgram::create(['name' => 'Sistem Informasi', 'code' => 'SI']);

        // 3. Ruangan
        $room1 = Room::create(['name' => 'Ruang Teori 101', 'code' => 'R-101', 'capacity' => 40]);
        $room2 = Room::create(['name' => 'Laboratorium Komputer', 'code' => 'LAB-KOM', 'capacity' => 30]);
        $room3 = Room::create(['name' => 'Gedung Serbaguna A', 'code' => 'GSG-A', 'capacity' => 100]);


        // 4. Dosen
        $dosen1 = Lecturer::create(['study_program_id' => $prodiTI->id, 'name' => 'Dr. Budi Santoso, M.Kom.', 'nip' => '198001012005011001', 'email' => 'budi.s@kampus.ac.id']);
        $dosen2 = Lecturer::create(['study_program_id' => $prodiSI->id, 'name' => 'Dr. Siti Aminah, M.T.', 'nip' => '198202022006022002', 'email' => 'siti.a@kampus.ac.id']);
        $dosen3 = Lecturer::create(['study_program_id' => $prodiTI->id, 'name' => 'Rina Hartati, S.Kom., M.Cs.', 'nip' => '199003032015032003', 'email' => 'rina.h@kampus.ac.id']);

        // 5. Mata Kuliah
        $course1 = Course::create(['study_program_id' => $prodiTI->id, 'name' => 'Algoritma & Pemrograman', 'code' => 'TI-001', 'credits' => 3]);
        $course2 = Course::create(['study_program_id' => $prodiSI->id, 'name' => 'Manajemen Proyek SI', 'code' => 'SI-001', 'credits' => 3]);
        $course3 = Course::create(['study_program_id' => $prodiTI->id, 'name' => 'Basis Data Lanjutan', 'code' => 'TI-002', 'credits' => 4]);

        // 6. Kelas / Rombel
        $group1 = StudentGroup::create(['study_program_id' => $prodiTI->id, 'academic_year_id' => $activeAcademicYear->id, 'name' => 'TI Pagi 2023']);
        $group2 = StudentGroup::create(['study_program_id' => $prodiSI->id, 'academic_year_id' => $activeAcademicYear->id, 'name' => 'SI Sore 2022']);

        // --- Buat Contoh Jadwal ---

        Schedule::create([
            'academic_year_id' => $activeAcademicYear->id,
            'lecturer_id' => $dosen1->id,
            'course_id' => $course1->id,
            'room_id' => $room2->id,
            'student_group_id' => $group1->id,
            'day_of_week' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '10:30',
        ]);

        Schedule::create([
            'academic_year_id' => $activeAcademicYear->id,
            'lecturer_id' => $dosen2->id,
            'course_id' => $course2->id,
            'room_id' => $room1->id,
            'student_group_id' => $group2->id,
            'day_of_week' => 'Selasa',
            'start_time' => '13:00',
            'end_time' => '15:30',
        ]);

        Schedule::create([
            'academic_year_id' => $activeAcademicYear->id,
            'lecturer_id' => $dosen3->id,
            'course_id' => $course3->id,
            'room_id' => $room2->id,
            'student_group_id' => $group1->id,
            'day_of_week' => 'Rabu',
            'start_time' => '10:00',
            'end_time' => '13:00',
        ]);

        $this->command->info('Seeder data akademik berhasil dijalankan!');
    }
}
