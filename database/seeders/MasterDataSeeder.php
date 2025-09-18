<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudyProgram;
use App\Models\AcademicYear;
use App\Models\Room;
use App\Models\Lecturer;
use App\Models\Course;
use App\Models\StudentGroup;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Tahun Ajaran
        $activeAcademicYear = AcademicYear::create([
            'year' => '2025/2026',
            'semester' => 'Ganjil',
            'is_active' => true,
        ]);

        // Buat Program Studi
        $prodiTI = StudyProgram::create(['name' => 'Teknik Informatika', 'code' => 'TI']);
        $prodiSI = StudyProgram::create(['name' => 'Sistem Informasi', 'code' => 'SI']);

        // Buat Ruangan
        Room::create(['name' => 'Ruang Teori 101', 'code' => 'R-101', 'capacity' => 40]);
        Room::create(['name' => 'Laboratorium Komputer', 'code' => 'LAB-KOM', 'capacity' => 30]);

        // Buat Dosen
        Lecturer::create(['study_program_id' => $prodiTI->id, 'name' => 'Dr. Budi Santoso', 'nip' => '198001012005011001', 'email' => 'budi.s@kampus.ac.id']);
        Lecturer::create(['study_program_id' => $prodiSI->id, 'name' => 'Dr. Siti Aminah', 'nip' => '198202022006022002', 'email' => 'siti.a@kampus.ac.id']);

        // Buat Mata Kuliah
        Course::create(['study_program_id' => $prodiTI->id, 'name' => 'Algoritma & Pemrograman', 'code' => 'TI-001', 'credits' => 3]);
        Course::create(['study_program_id' => $prodiSI->id, 'name' => 'Manajemen Proyek SI', 'code' => 'SI-001', 'credits' => 3]);

        // Buat Kelas / Rombel
        StudentGroup::create(['study_program_id' => $prodiTI->id, 'academic_year_id' => $activeAcademicYear->id, 'name' => 'TI Pagi 2023']);
    }
}
