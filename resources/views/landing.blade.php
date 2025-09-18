<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Flow</title>
    <link href="{{ asset('assets/img/apple.png') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">
                <img src="{{ asset('assets/img/campus-flow.png') }}" alt="Logo KampusFlow" class="img-fluid">
            </a>
            <a href="/admin" class="btn btn-primary">Login Admin</a>
        </div>
    </nav>

    <main>
        <section class="hero-section">
            <div class="container hero-container">
                <div class="hero-text">
                    <h1>
                        {{ $contents->get('hero_title', 'Judul Default Jika Kosong') }}
                        <span class="highlight">Kini Jadi Mudah.</span>
                    </h1>
                    <p>
                        {{ $contents->get('hero_subtitle', 'Sub-judul default.') }}
                    </p>
                    <div class="hero-buttons">
                        <a href="#"
                            class="btn btn-primary">{{ $contents->get('hero_button_primary', 'Tombol 1') }}</a>
                        <a href="#"
                            class="btn btn-secondary">{{ $contents->get('hero_button_secondary', 'Tombol 2') }}</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.pexels.com/photos/1205651/pexels-photo-1205651.jpeg"
                        alt="Mockup Aplikasi KampusFlow">
                </div>
            </div>
        </section>

        <section class="problem-section">
            <div class="container">
                <div class="section-title">
                    <h2>Kenapa KampusFlow?</h2>
                    <p>Karena kami mengerti masalah fundamental dalam penjadwalan akademik.</p>
                </div>
                <div class="problem-grid">
                    <div class="problem-card">
                        <i data-feather="alert-triangle"></i>
                        <h3>Jadwal Bentrok? Lupakan.</h3>
                        <p>Algoritma cerdas kami secara proaktif mendeteksi konflik dosen, ruangan, dan kelas sebelum
                            jadwal disimpan.</p>
                    </div>
                    <div class="problem-card">
                        <i data-feather="clock"></i>
                        <h3>Proses Manual & Lama? Tinggalkan.</h3>
                        <p>Antarmuka yang intuitif mempercepat proses penyusunan jadwal dari berhari-hari menjadi hanya
                            beberapa jam.</p>
                    </div>
                    <div class="problem-card">
                        <i data-feather="share-2"></i>
                        <h3>Koordinasi Tersebar? Satukan.</h3>
                        <p>Semua data terpusat dalam satu platform, menjadi satu-satunya sumber kebenaran untuk seluruh
                            civitas akademika.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="features-section">
            <div class="container">
                <div class="section-title">
                    <h2>Fitur Unggulan Kami</h2>
                    <p>Semua yang Anda butuhkan untuk manajemen penjadwalan yang efisien.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-image">
                        <img src="https://images.pexels.com/photos/267582/pexels-photo-267582.jpeg"
                            alt="Manajemen Jadwal Terpusat">
                    </div>
                    <div class="feature-text">
                        <h3>Manajemen Jadwal Terpusat</h3>
                        <p>Lihat semua jadwal dalam satu tampilan yang terorganisir. Kelompokkan berdasarkan hari,
                            filter berdasarkan prodi, dan temukan informasi yang Anda butuhkan dalam hitungan detik.</p>
                    </div>
                </div>
                <div class="feature-item reverse">
                    <div class="feature-image">
                        <img src="https://images.pexels.com/photos/5676744/pexels-photo-5676744.jpeg"
                            alt="Deteksi Konflik Cerdas">
                    </div>
                    <div class="feature-text">
                        <h3>Deteksi Konflik Cerdas</h3>
                        <p>Sistem tidak akan membiarkan Anda membuat kesalahan. Setiap jadwal baru atau perubahan akan
                            divalidasi secara real-time untuk mencegah tumpang tindih yang merugikan.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-image">
                        <img src="https://images.pexels.com/photos/12662920/pexels-photo-12662920.jpeg"
                            alt="Ekspor Data Profesional">
                    </div>
                    <div class="feature-text">
                        <h3>Ekspor Data Profesional</h3>
                        <p>Butuh laporan untuk rapat atau untuk ditempel di mading? Ekspor semua data jadwal ke dalam
                            format Excel yang rapi hanya dengan satu kali klik.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials-section">
            <div class="container">
                <div class="section-title">
                    <h2>Apa Kata Mereka?</h2>
                </div>
                <div class="testimonial-grid">
                    <div class="testimonial-card">
                        <p>"Sebagai Kepala Prodi, KampusFlow menghemat waktu kami puluhan jam setiap semester. Fitur
                            deteksi bentroknya adalah penyelamat!"</p>
                        <h4>Dr. Anisa, M.Kom.</h4>
                        <span>Kepala Prodi Teknik Informatika</span>
                    </div>
                    <div class="testimonial-card">
                        <p>"Akhirnya ada sistem yang mudah digunakan dan benar-benar mengerti masalah kami di bagian
                            akademik. Luar biasa!"</p>
                        <h4>Ahmad Syaiful, S.E.</h4>
                        <span>Staf Akademik, Fakultas Ekonomi</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <h2>Siap Mengubah Wajah Penjadwalan di Kampus Anda?</h2>
                <p>Jadwalkan presentasi singkat atau coba demo interaktif kami.</p>
                <a href="#" class="btn btn-primary btn-large">Jadwalkan Presentasi</a>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>© 2025 KampusFlow. Dibuat dengan ❤ oleh [BitterSweet.code].</p>
        </div>
    </footer>

    <script>
        feather.replace()
    </script>
</body>

</html>
