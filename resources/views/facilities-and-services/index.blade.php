<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Temukan fasilitas dan layanan unggulan RS St. Elisabeth Semarang — dari Pelayanan Stroke Terpadu, ICU, IGD 24 Jam, hingga Klinik Spesialis berstandar tinggi.">
    <title>Fasilitas & Layanan - RS St. Elisabeth Semarang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite([
        'resources/js/navbar/navbar.js',
        'resources/js/navbar/navbar-dropdown.js',
        'resources/js/facilities-and-services/facilities.js',
        'resources/css/style.css',
        'resources/css/navbar-dropdown.css',
        'resources/css/facilities-and-services.css'
    ])
</head>
<body>

    {{-- ===== NAVBAR ATAS (sama dengan home) ===== --}}
    <header class="nav-group">
        <nav class="navbar bg-body-tertiary">
            <div class="container d-flex">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo RS St. Elisabeth Semarang" width="auto" height="70" class="d-inline-block align-text-top">
                    <img src="{{ asset('images/akreditasi.png') }}" alt="Akreditasi RS St. Elisabeth Semarang" width="auto" height="70" class="d-inline-block align-text-top">
                </a>
                <form class="d-flex nav-form-search" role="search">
                    <input class="form-control me-2" type="search" placeholder="Temukan dokter, klinik, jadwal.." aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <a href="#" class="navbar-brand ambulance-call" aria-label="Hubungi IGD 24 Jam">
                    <i class="fa-solid fa-truck-medical"></i>
                    <span class="">IGD 24</span>
                </a>
                <div class="d-none">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Log In</a></li>
                        <li><a class="dropdown-item" href="#">Create Account</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div id="navbar-sentinel" class="navbar-sentinel"></div>

    {{-- ===== SECOND NAVBAR (sama dengan home) ===== --}}
    <nav id="second-navbar" class="navbar navbar-expand-lg second-nav">
        <div class="container second-nav-body">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                <ul class="navbar-nav nav-content gap-2">
                    <li class="nav-item nav-beranda">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>
                    <li class="nav-item dropdown nav-tentang-kami">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tentang Kami</a></li>
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li><a class="dropdown-item" href="#">Direksi</a></li>
                            <li><a class="dropdown-item" href="#">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#">Akreditasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item nav-cari-dokter">
                        <a class="nav-link" href="#">Cari Dokter</a>
                    </li>
                    <li class="nav-item nav-ruang-perawatan">
                        <a class="nav-link" href="#">Ruang Perawatan</a>
                    </li>
                    <li class="nav-item nav-fasilitas">
                        <a class="nav-link active" aria-current="page" href="#">Fasilitas</a>
                    </li>
                    <li class="nav-item nav-paket-dan-promo">
                        <a class="nav-link" href="{{ route('promotions.index') }}">Paket dan Promo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <h1 class="visually-hidden">Fasilitas dan Layanan RS Santa Elisabeth Semarang</h1>

        {{-- ===== HERO SECTION (diambil dari promotions/index.blade.php) ===== --}}
        <section id="hero-section">
            <div class="container">
                {{-- Breadcrumb --}}
                <nav class="hero-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb flex-wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fasilitas & Layanan</li>
                    </ol>
                </nav>

                <div class="row">
                    {{-- Kolom kiri: Judul, subjudul --}}
                    <div class="col-12 col-lg-8">
                        <h2 class="hero-title">Fasilitas &amp; Layanan Unggulan</h2>
                        <p class="hero-subtitle">Kami menyediakan fasilitas dan layanan berteknologi canggih demi memberikan pelayanan yang berkualitas dan paripurna kepada setiap pasien.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== INTRO SECTION ===== --}}
        <section id="facilities-intro">
            <div class="container text-center">
                <div class="intro-label">
                    <span>LAYANAN &amp; FASILITAS</span>
                </div>
                <p class="intro-desc">
                    Kami menyediakan Layanan dan Fasilitas berteknologi canggih demi memberikan pelayanan yang berkualitas dan paripurna.
                </p>
            </div>
        </section>

        {{-- ===== FASILITAS UTAMA: LIST + DETAIL ===== --}}
        <section id="facilities-main">
            <div class="container">
                <div class="row g-4 align-items-start">

                    {{-- ---- Kolom Kiri: Daftar Fasilitas ---- --}}
                    <div class="col-12 col-lg-4">
                        <div class="facility-sidebar">
                            <div class="facility-sidebar-header">
                                <i class="fa-solid fa-list-ul"></i>
                                <span>Pilih Fasilitas</span>
                            </div>
                            <div class="facility-list">
                                <button class="btn-facility" data-target="facility-stroke">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Stroke Terpadu
                                </button>
                                <button class="btn-facility" data-target="facility-nyeri">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Klinik Nyeri
                                </button>
                                <button class="btn-facility" data-target="facility-neuro">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Neurofisiologi
                                </button>
                                <button class="btn-facility" data-target="facility-igd">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Gawat Darurat
                                </button>
                                <button class="btn-facility" data-target="facility-icu">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Ruang Rawat Intensif
                                </button>
                                <button class="btn-facility" data-target="facility-klinik">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Klinik Spesialis dan Gigi
                                </button>
                                <button class="btn-facility" data-target="facility-mcu">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Medical Check Up
                                </button>
                                <button class="btn-facility" data-target="facility-homecare">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Homecare
                                </button>
                                <button class="btn-facility" data-target="facility-hemodialisa">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Hemodialisa
                                </button>
                                <button class="btn-facility" data-target="facility-kemoterapi">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Kemoterapi
                                </button>
                                <button class="btn-facility" data-target="facility-bedah">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Bedah
                                </button>
                                <button class="btn-facility" data-target="facility-lab">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Instalasi Laboratorium Sentral
                                </button>
                                <button class="btn-facility" data-target="facility-radiologi">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Radiologi
                                </button>
                                <button class="btn-facility" data-target="facility-farmasi">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Farmasi
                                </button>
                                <button class="btn-facility" data-target="facility-gizi">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Gizi
                                </button>
                                <button class="btn-facility" data-target="facility-rehabilitasi">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    Pelayanan Rehabilitasi Medik
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ---- Kolom Kanan: Detail Panel ---- --}}
                    <div class="col-12 col-lg-8">
                        <div class="facility-detail-panel">

                            {{-- 1. Pelayanan Stroke Terpadu --}}
                            <div class="facility-detail-item" id="facility-stroke">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670220299.jpg') }}" alt="Pelayanan Stroke Terpadu RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Unggulan</span>
                                    <h3 class="facility-name">Pelayanan Stroke Terpadu</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Pelayanan Stroke Terpadu RS St. Elisabeth Semarang menyediakan layanan komprehensif bagi pasien stroke, mulai dari penanganan akut hingga rehabilitasi. Didukung oleh tim dokter spesialis saraf, fisioterapis, dan tenaga medis berpengalaman.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Unit ini dilengkapi dengan peralatan diagnostik dan terapeutik terkini untuk memastikan penanganan yang cepat, tepat, dan menyeluruh.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Tim Multidisiplin</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Rehabilitasi Pasca Stroke</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Alat Diagnostik Modern</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Layanan 24 Jam</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20Pelayanan%20Stroke%20Terpadu" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                        <a href="https://regonline.rs-elisabeth.com" target="_blank" class="btn-outline-facility">
                                            <i class="fa-regular fa-calendar-check"></i> Buat Janji
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 2. Klinik Nyeri --}}
                            <div class="facility-detail-item" id="facility-nyeri">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670914854.jpg') }}" alt="Klinik Nyeri RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Spesialis</span>
                                    <h3 class="facility-name">Klinik Nyeri</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Klinik Nyeri RS St. Elisabeth menyediakan layanan penanganan nyeri kronis maupun akut secara komprehensif. Tim dokter spesialis anestesi dan nyeri kami berpengalaman dalam menangani berbagai kondisi nyeri yang mengganggu kualitas hidup pasien.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Dengan pendekatan multidisiplin, kami membantu pasien mengelola dan meredakan nyeri secara efektif dan berkelanjutan.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Nyeri Kronis & Akut</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Spesialis Anestesi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Terapi Non-Invasif</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20Klinik%20Nyeri" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                        <a href="https://regonline.rs-elisabeth.com" target="_blank" class="btn-outline-facility">
                                            <i class="fa-regular fa-calendar-check"></i> Buat Janji
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 3. Pelayanan Neurofisiologi --}}
                            <div class="facility-detail-item" id="facility-neuro">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670914872.jpg') }}" alt="Pelayanan Neurofisiologi RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Spesialis</span>
                                    <h3 class="facility-name">Pelayanan Neurofisiologi</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Layanan Neurofisiologi kami menyediakan pemeriksaan dan evaluasi fungsi sistem saraf secara komprehensif menggunakan teknologi terkini. Pelayanan ini mencakup EEG, EMG, dan berbagai pemeriksaan neurofisiologi diagnostik lainnya.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Didukung oleh dokter spesialis saraf yang berpengalaman untuk membantu diagnosis penyakit saraf secara akurat dan cepat.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> EEG & EMG</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Diagnosa Akurat</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Teknologi Terkini</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20Pelayanan%20Neurofisiologi" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                        <a href="https://regonline.rs-elisabeth.com" target="_blank" class="btn-outline-facility">
                                            <i class="fa-regular fa-calendar-check"></i> Buat Janji
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 4. Pelayanan Gawat Darurat --}}
                            <div class="facility-detail-item" id="facility-igd">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1671680565.jpg') }}" alt="Pelayanan Gawat Darurat RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">24 Jam</span>
                                    <h3 class="facility-name">Pelayanan Gawat Darurat</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Instalasi Gawat Darurat (IGD) RS St. Elisabeth Semarang menyediakan layanan gawat darurat 24 jam, yang dilayani oleh dokter, perawat, dan tenaga medis lain yang handal, berpengalaman, dan memiliki sertifikasi dalam penanganan kegawatdaruratan.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Kami juga terhubung dengan pelayanan laboratorium 24 jam, radiologi 24 jam, Instalasi Bedah Sentral 24 jam, dan Ruang Rawat Intensif untuk memberikan penanganan menyeluruh.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Buka 24 Jam</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Dokter Jaga Terlatih</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Terintegrasi ICU</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Lab & Radiologi 24 Jam</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="tel:02485022440" class="btn-primary-facility">
                                            <i class="fa-solid fa-phone"></i> Hubungi IGD
                                        </a>
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20butuh%20informasi%20IGD" target="_blank" class="btn-outline-facility">
                                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 5. Ruang Rawat Intensif (ICU) --}}
                            <div class="facility-detail-item" id="facility-icu">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1671680579.jpg') }}" alt="Ruang Rawat Intensif RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Intensif</span>
                                    <h3 class="facility-name">Ruang Rawat Intensif</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Ruang Rawat Intensif (ICU/ICCU) RS St. Elisabeth Semarang dilengkapi dengan peralatan canggih dan ditangani oleh tenaga medis yang terlatih khusus untuk menangani pasien dengan kondisi kritis. Pemantauan dilakukan secara terus-menerus selama 24 jam.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Rasio perawat terhadap pasien yang optimal memastikan setiap pasien mendapat perhatian penuh dan penanganan yang cepat tanggap.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Monitoring 24 Jam</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Alat Canggih</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Tenaga Terlatih</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> ICU & ICCU</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20Ruang%20Rawat%20Intensif" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 6. Klinik Spesialis dan Gigi --}}
                            <div class="facility-detail-item" id="facility-klinik">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1671680659.jpg') }}" alt="Klinik Spesialis dan Gigi RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Klinik Spesialis</span>
                                    <h3 class="facility-name">Klinik Spesialis dan Gigi</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        RS St. Elisabeth Semarang memiliki berbagai klinik spesialis yang ditangani oleh dokter-dokter ahli berpengalaman di bidangnya masing-masing. Tersedia juga klinik gigi dan mulut untuk perawatan kesehatan gigi yang komprehensif.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Klinik kami mencakup spesialis jantung, saraf, anak, kandungan, penyakit dalam, bedah, orthopedi, mata, THT, kulit, dan banyak lagi.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Multi Spesialis</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Klinik Gigi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Jadwal Fleksibel</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="{{ route('dokter.index') }}" class="btn-primary-facility">
                                            <i class="fa-solid fa-user-doctor"></i> Cari Dokter
                                        </a>
                                        <a href="https://regonline.rs-elisabeth.com" target="_blank" class="btn-outline-facility">
                                            <i class="fa-regular fa-calendar-check"></i> Buat Janji
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 7. Medical Check Up --}}
                            <div class="facility-detail-item" id="facility-mcu">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/feature.jpg') }}" alt="Medical Check Up RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Paket Kesehatan</span>
                                    <h3 class="facility-name">Medical Check Up</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Program Medical Check Up (MCU) RS St. Elisabeth Semarang dirancang untuk mendeteksi kondisi kesehatan secara dini sebelum gejala muncul. Tersedia berbagai paket MCU yang dapat disesuaikan dengan kebutuhan individu maupun korporasi.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Hasil pemeriksaan ditangani oleh dokter spesialis yang akan memberikan konsultasi dan rekomendasi tindak lanjut secara komprehensif.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Paket Individu & Korporasi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Hasil Cepat</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Konsultasi Dokter</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20paket%20MCU" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Tanya Paket MCU
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 8. Homecare --}}
                            <div class="facility-detail-item" id="facility-homecare">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1671680579.jpg') }}" alt="Homecare RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Rumah</span>
                                    <h3 class="facility-name">Homecare</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Layanan Homecare RS St. Elisabeth Semarang menghadirkan perawatan medis berkualitas langsung ke rumah pasien. Layanan ini mencakup perawatan luka, injeksi, pemasangan infus, pemantauan kondisi pasien, dan berbagai tindakan medis lainnya.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Tim perawat dan tenaga medis profesional kami siap memberikan pelayanan terbaik dengan standar rumah sakit di lingkungan rumah pasien.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Perawatan di Rumah</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Tenaga Profesional</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Standar RS</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20pesan%20layanan%20Homecare" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Pesan Layanan
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 9. Hemodialisa --}}
                            <div class="facility-detail-item" id="facility-hemodialisa">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670914854.jpg') }}" alt="Hemodialisa RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Spesialis</span>
                                    <h3 class="facility-name">Hemodialisa</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Unit Hemodialisa RS St. Elisabeth Semarang menyediakan layanan cuci darah (dialisis) bagi pasien gagal ginjal dengan menggunakan mesin dialisis modern yang terpercaya. Layanan ini tersedia secara rutin dengan jadwal yang fleksibel.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Pasien ditangani oleh tim dokter spesialis nefrologi dan perawat yang berpengalaman dalam perawatan gagal ginjal kronis.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Mesin Dialisis Modern</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Spesialis Nefrologi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Jadwal Rutin</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20Hemodialisa" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 10. Kemoterapi --}}
                            <div class="facility-detail-item" id="facility-kemoterapi">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670914872.jpg') }}" alt="Kemoterapi RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Onkologi</span>
                                    <h3 class="facility-name">Kemoterapi</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Layanan Kemoterapi RS St. Elisabeth Semarang memberikan penanganan kanker dengan kemoterapi yang dilakukan oleh tim dokter onkologi berpengalaman. Fasilitas kami dirancang untuk memberikan kenyamanan dan keamanan selama sesi kemoterapi berlangsung.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Didukung oleh layanan farmasi khusus onkologi untuk memastikan dosis dan pemberian obat yang tepat dan aman bagi setiap pasien.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Dokter Onkologi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Farmasi Onkologi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Ruang Nyaman</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20Kemoterapi" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 11. Pelayanan Bedah --}}
                            <div class="facility-detail-item" id="facility-bedah">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1671680565.jpg') }}" alt="Pelayanan Bedah RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Bedah</span>
                                    <h3 class="facility-name">Pelayanan Bedah</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Instalasi Bedah Sentral RS St. Elisabeth Semarang dilengkapi dengan kamar operasi modern dan peralatan medis canggih. Kami menyediakan berbagai jenis tindakan bedah, mulai dari bedah umum, orthopedi, urologi, hingga bedah saraf.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Tim dokter bedah, anestesi, dan perawat yang terlatih memastikan setiap prosedur operasi berjalan dengan aman dan optimal.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Multi Spesialisasi Bedah</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Kamar Operasi Modern</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Tim Anestesi Berpengalaman</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20konsultasi%20Pelayanan%20Bedah" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Konsultasi
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 12. Laboratorium Sentral --}}
                            <div class="facility-detail-item" id="facility-lab">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670220299.jpg') }}" alt="Laboratorium Sentral RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Diagnostik</span>
                                    <h3 class="facility-name">Instalasi Laboratorium Sentral</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Instalasi Laboratorium Sentral RS St. Elisabeth Semarang beroperasi 24 jam dan dilengkapi dengan peralatan laboratorium terkini. Kami menyediakan pemeriksaan hematologi, kimia darah, urinalisis, mikrobiologi, dan berbagai pemeriksaan laboratorium lainnya.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Hasil pemeriksaan yang akurat dan cepat mendukung diagnosis yang tepat oleh dokter untuk penanganan optimal.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Buka 24 Jam</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Hasil Akurat & Cepat</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Peralatan Modern</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20Laboratorium" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 13. Radiologi --}}
                            <div class="facility-detail-item" id="facility-radiologi">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1671680659.jpg') }}" alt="Pelayanan Radiologi RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Diagnostik Pencitraan</span>
                                    <h3 class="facility-name">Pelayanan Radiologi</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Pelayanan Radiologi RS St. Elisabeth Semarang menyediakan berbagai layanan pencitraan medis yang canggih, termasuk CT Scan, MRI, X-Ray digital, USG, dan Mamografi. Tersedia 24 jam untuk mendukung kebutuhan diagnostik gawat darurat maupun elektif.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Hasilnya dibaca dan diinterpretasikan oleh dokter spesialis radiologi yang berpengalaman untuk akurasi diagnosa yang optimal.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> CT Scan & MRI</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> X-Ray Digital</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> USG & Mamografi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Buka 24 Jam</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20Radiologi" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 14. Farmasi --}}
                            <div class="facility-detail-item" id="facility-farmasi">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670914854.jpg') }}" alt="Pelayanan Farmasi RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Farmasi</span>
                                    <h3 class="facility-name">Pelayanan Farmasi</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Instalasi Farmasi RS St. Elisabeth Semarang menyediakan pelayanan kefarmasian yang komprehensif meliputi penyediaan obat-obatan, konseling obat oleh apoteker, dan pelayanan farmasi klinik. Beroperasi 24 jam untuk mendukung kebutuhan pasien rawat inap dan rawat jalan.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Kami memastikan setiap pasien mendapatkan obat yang tepat, dosis yang benar, dan informasi penggunaan yang lengkap.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Buka 24 Jam</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Konseling Apoteker</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Farmasi Klinik</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20Farmasi" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 15. Gizi --}}
                            <div class="facility-detail-item" id="facility-gizi">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/feature.jpg') }}" alt="Pelayanan Gizi RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Layanan Gizi</span>
                                    <h3 class="facility-name">Pelayanan Gizi</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Pelayanan Gizi RS St. Elisabeth Semarang menyediakan konseling gizi dan penyusunan diet khusus yang disesuaikan dengan kondisi kesehatan setiap pasien. Didukung oleh ahli gizi klinis berpengalaman yang akan membantu pemulihan dan peningkatan status gizi pasien.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Layanan katering pasien kami memastikan makanan yang disajikan bergizi, higienis, dan sesuai dengan kondisi medis setiap pasien.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Konseling Gizi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Diet Medis Khusus</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Ahli Gizi Klinis</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20konsultasi%20Gizi" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Konsultasi Gizi
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- 16. Rehabilitasi Medik --}}
                            <div class="facility-detail-item" id="facility-rehabilitasi">
                                <div class="facility-img-wrapper">
                                    <img src="{{ asset('images/F1670914872.jpg') }}" alt="Pelayanan Rehabilitasi Medik RS St. Elisabeth Semarang">
                                </div>
                                <div class="facility-content-body">
                                    <span class="facility-tag">Rehabilitasi</span>
                                    <h3 class="facility-name">Pelayanan Rehabilitasi Medik</h3>
                                    <hr class="facility-divider">
                                    <p class="facility-desc">
                                        Pelayanan Rehabilitasi Medik RS St. Elisabeth Semarang menyediakan program fisioterapi, terapi wicara, terapi okupasi, dan berbagai modalitas rehabilitasi lainnya. Program ini dirancang untuk memaksimalkan pemulihan fungsi tubuh pasien setelah sakit, cedera, atau operasi.
                                    </p>
                                    <p class="facility-desc mt-2">
                                        Didukung oleh dokter spesialis kedokteran fisik dan rehabilitasi serta fisioterapis terlatih yang akan menyusun program rehabilitasi yang disesuaikan dengan kebutuhan individual pasien.
                                    </p>
                                    <div class="facility-highlights">
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Fisioterapi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Terapi Wicara</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Terapi Okupasi</span>
                                        <span class="facility-highlight-badge"><i class="fa-solid fa-check-circle"></i> Program Individual</span>
                                    </div>
                                    <div class="facility-cta">
                                        <a href="https://wa.me/6285600600870?text=Halo%2C%20saya%20ingin%20informasi%20Rehabilitasi%20Medik" target="_blank" class="btn-primary-facility">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi Kami
                                        </a>
                                        <a href="https://regonline.rs-elisabeth.com" target="_blank" class="btn-outline-facility">
                                            <i class="fa-regular fa-calendar-check"></i> Buat Janji
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>{{-- END .facility-detail-panel --}}
                    </div>{{-- END kolom kanan --}}

                </div>{{-- END .row --}}
            </div>{{-- END .container --}}
        </section>

    </main>

    {{-- ===== FOOTER ===== --}}
    <footer id="footer" class="pt-5">
        <div class="container-fluid col-12 col-md-12">
            <div class="container">
                <div class="row footer-body">
                    <div class="col mb-5">
                        <div class="footer-header mb-4">
                            <ul>
                                <li><h4 class="rs-name">RS St. Elisabeth Semarang</h4></li>
                                <li><p class="moto">Pancaran cintanya menyembuhkan derita sesama</p></li>
                            </ul>
                        </div>
                        <ul>
                            <li><h4 class="footer-title">Hubungi Kami</h4></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-location-dot"></i> Jl. Kawi No.1</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-phone"></i> (024) 8502244</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-phone"></i> (024) 8310076 / (024) 8310035</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-envelope"></i> sekretariat@365.rs-elisabeth.com</a></li>
                        </ul>
                        <div class="social-media d-flex gap-2">
                            <div class="insta"><i class="fa-brands fa-instagram"></i></div>
                            <div class="facebook"><i class="fa-brands fa-facebook"></i></div>
                            <div class="youtube"><i class="fa-brands fa-youtube"></i></div>
                        </div>
                    </div>
                    <div class="col">
                        <ul>
                            <li><h4 class="footer-title">Tautan Cepat</h4></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-caret-right"></i> Tentang Kami</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-caret-right"></i> Elisanews</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-caret-right"></i> Artikel</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-caret-right"></i> Hubungi Kami</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-caret-right"></i> Rekanan</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-caret-right"></i> Perpustakaan Online</a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            <li><h4 class="footer-title">Elisameds</h4></li>
                            <li class="footer-list">
                                <p class="elisameds-desc">Aplikasi Mobile Rumah Sakit St. Elisabeth Semarang untuk meningkatkan kualitas pelayanan kesehatan kepada pasien.</p>
                            </li>
                            <li><a href="https://play.google.com/store/apps/details?id=com.elisameds.app" aria-label="Unduh aplikasi Elisameds di Google Play Store"><i class="fa-brands fa-google-play"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row footer-copyright">
                    <div class="col">
                        <p class="copyright"><i class="fa-solid fa-copyright"></i> 2026 Rumah Sakit Santa Elisabeth Semarang</p>
                    </div>
                    <div class="col d-flex justify-content-center gap-3">
                        <p class="d-inline-block">Designed By Lorem, ipsum dolor.</p>
                        <p class="d-inline-block">Developed By Lorem, ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/726e331ad1.js" crossorigin="anonymous"></script>
</body>
</html>
