<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPageContent;
use Illuminate\Support\Facades\DB;

class LandingPageContentSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel dulu biar datanya selalu fresh
        DB::table('landing_page_contents')->truncate();

        $contents = [
            // Hero Section
            ['section' => 'hero_title', 'content' => 'Otomatisasi Penjadwalan Akademik yang Rumit, Kini Jadi Mudah.'],
            ['section' => 'hero_subtitle', 'content' => 'KampusFlow adalah platform cerdas yang dirancang untuk staf akademik modern. Susun, kelola, dan publikasikan jadwal perkuliahan tanpa stres dan bentrok.'],
            ['section' => 'hero_button_primary', 'content' => 'Lihat Demo'],
            ['section' => 'hero_button_secondary', 'content' => 'Hubungi Kami'],

            // Problem & Solution Section
            ['section' => 'problem_title', 'content' => 'Kenapa KampusFlow?'],
            ['section' => 'problem_subtitle', 'content' => 'Karena kami mengerti masalah fundamental dalam penjadwalan akademik.'],
            ['section' => 'problem_1_title', 'content' => 'Jadwal Bentrok? Lupakan.'],
            ['section' => 'problem_1_text', 'content' => 'Algoritma cerdas kami secara proaktif mendeteksi konflik dosen, ruangan, dan kelas sebelum jadwal disimpan.'],
            ['section' => 'problem_2_title', 'content' => 'Proses Manual & Lama? Tinggalkan.'],
            ['section' => 'problem_2_text', 'content' => 'Antarmuka yang intuitif mempercepat proses penyusunan jadwal dari berhari-hari menjadi hanya beberapa jam.'],
            ['section' => 'problem_3_title', 'content' => 'Koordinasi Tersebar? Satukan.'],
            ['section' => 'problem_3_text', 'content' => 'Semua data terpusat dalam satu platform, menjadi satu-satunya sumber kebenaran untuk seluruh civitas akademika.'],

            // Dan seterusnya untuk section lain...
            ['section' => 'final_cta_title', 'content' => 'Siap Mengubah Wajah Penjadwalan di Kampus Anda?'],
            ['section' => 'final_cta_button', 'content' => 'Jadwalkan Presentasi'],
        ];

        // Masukkan data ke database
        foreach ($contents as $content) {
            LandingPageContent::create($content);
        }

        $this->command->info('Seeder konten landing page berhasil dijalankan!');
    }
}
