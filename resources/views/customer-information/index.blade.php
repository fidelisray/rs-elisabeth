<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Informasi Pelanggan Rumah Sakit St. Elisabeth Semarang">
    <title>Informasi Pelanggan - RS St. Elisabeth Semarang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite([
        'resources/css/style.css',
        'resources/css/btn-accent.css',
        'resources/css/navbar-dropdown.css',
        'resources/css/top-bar.css',
        'resources/css/search-and-quick-access.css',
        'resources/css/customer-information.css'
    ])
</head>
<body>
            <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="tel:+62248502244" class="ambulance-call p-1 px-3 d-inline-block text-white text-decoration-none"
                        style="border-radius: 1.5rem; border: 1px solid #d10202; background-color: #d10202; font-weight:600; margin-left: 0;">
                        <i class="fa-solid fa-truck-medical me-1"></i> IGD 24 Jam
                    </a>
                    <a href="tel:+62248502244" class="text-white text-decoration-none"><i class="fas fa-phone-alt me-2"></i> (024) 8502244</a>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#"><i class="fas fa-user-circle me-1"></i> Portal Pasien</a>
                    <a href="#"><i class="fas fa-globe me-1"></i> ID <i class="fas fa-chevron-down ms-1"
                            style="font-size: 0.7em;"></i></a>
                </div>
            </div>
        </div>
    </div>
    <header class="nav-group">
        <nav class="navbar bg-body-tertiary">
            <div class="container d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-center gap-3">
                <a class="navbar-brand m-0" href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo RS St. Elisabeth Semarang" width="auto" height="50" class="d-inline-block align-text-top logo-main">
                    <img src="{{ asset('images/akreditasi.png') }}" alt="Logo RS St. Elisabeth Semarang" width="auto" height="50" class="d-inline-block align-text-top logo-akreditasi d-none d-sm-inline-block">
                </a>
                <form class="d-flex nav-form-search flex-grow-1 mx-lg-3 order-3 order-lg-2 w-100 w-lg-auto" role="search">
                    <input class="form-control me-2" type="search" placeholder="Temukan dokter, klinik, jadwal.." aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="d-flex align-items-center order-2 order-lg-3">
                    <a class="btn btn-accent btn-sm d-lg-none me-2" href="tel:+62248502244"><i class="fa-solid fa-phone"></i></a>
                    <a class="btn btn-accent btn-sm d-lg-none" href="https://regonline.rs-elisabeth.com" target="_blank" rel="noopener noreferrer"><i class="far fa-calendar-check"></i></a>
                    <a class="btn btn-accent d-none d-lg-inline-block" href="https://regonline.rs-elisabeth.com" target="_blank" rel="noopener noreferrer"><i class="far fa-calendar-check me-2"></i>Buat Janji</a>
                </div>
            </div>
        </nav>
    </header>
    <div id="navbar-sentinel" class="navbar-sentinel"></div>
    <nav id="second-navbar" class="navbar navbar-expand-lg second-nav">
        <div class="container second-nav-body">
                        <!-- Mobile Menu Modal Toggler -->
            <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="modal" data-bs-target="#mobileMenuModal" aria-controls="mobileMenuModal" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <span class="d-lg-none text-white fw-bold ms-2 me-auto">Menu Utama</span>

            <!-- Desktop Sidebar -->
            <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex" id="navbarNavDropdown">
                <ul class="navbar-nav nav-content gap-2">
                    <li class="nav-item nav-beranda">
                        <a class="nav-link " aria-current="page" href="{{ route('home.index') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown nav-tentang-kami">
                        <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('tentang-kami.index') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('tentang-kami.index') }}#visi-dan-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('tentang-kami.index') }}#sejarah-singkat">Sejarah</a></li>
                        </ul>
                    </li>
                    <li class="nav-item nav-cari-dokter">
                        <a class="nav-link " href="{{ route('dokter.index') }}">Cari Dokter</a>
                    </li>
                    <li class="nav-item nav-ruang-perawatan">
                        <a class="nav-link " href="{{ route('ruang-perawatan.index') }}">Ruang Perawatan</a>
                    </li>
                    <li class="nav-item nav-fasilitas">
                        <a class="nav-link " href="{{ route('facilities.index') }}">Fasilitas</a>
                    </li>
                    <li class="nav-item nav-paket-dan-promo">
                        <a class="nav-link " href="{{ route('promotions.index') }}">Paket dan Promo</a>
                    </li>
                    <li class="nav-item nav-informasi-pelanggan">
                        <a class="nav-link active" href="{{ route('customer-information.index') }}">Informasi Pelanggan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Modal -->
    <div class="modal fade" id="mobileMenuModal" tabindex="-1" aria-labelledby="mobileMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mobile-menu-dialog">
            <div class="modal-content mobile-menu-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <ul class="mobile-nav-list">
                        <li><a class="" href="{{ route('home.index') }}">Beranda</a></li>
                        <li>
                            <a href="#collapseTentangKamiMobile" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseTentangKamiMobile" class="d-flex justify-content-center align-items-center gap-2 ">
                                Tentang Kami <i class="fas fa-chevron-down" style="font-size: 0.8em;"></i>
                            </a>
                            <div class="collapse" id="collapseTentangKamiMobile">
                                <ul class="mobile-submenu-list">
                                    <li><a href="{{ route('tentang-kami.index') }}">Profil</a></li>
                                    <li><a href="{{ route('tentang-kami.index') }}#visi-dan-misi">Visi & Misi</a></li>
                                    <li><a href="{{ route('tentang-kami.index') }}#sejarah-singkat">Sejarah</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="" href="{{ route('dokter.index') }}">Cari Dokter</a></li>
                        <li><a class="" href="{{ route('ruang-perawatan.index') }}">Ruang Perawatan</a></li>
                        <li><a class="" href="{{ route('facilities.index') }}">Fasilitas</a></li>
                        <li><a class="" href="{{ route('promotions.index') }}">Paket dan Promo</a></li>
                        <li><a class="active" href="{{ route('customer-information.index') }}">Informasi Pelanggan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <main>
        <section id="hero-section">
            <div class="container">
                <!-- Breadcrumb -->
                <nav class="hero-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb flex-wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi Pelanggan</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <h1 class="hero-title">Informasi Pelanggan</h1>
                    </div>
                </div>
            </div>
        </section>

        <section id="customer-info" class="py-5 bg-light">
            <div class="container">
                <!-- JAM KUNJUNGAN PASIEN -->
                <div class="section-heading text-center mb-5">
                    <h2 class="d-inline-block position-relative pb-2 border-bottom border-primary border-2">Jam Kunjungan Pasien</h2>
                    <p class="mt-3 text-muted">Untuk menjaga ketenangan dan kenyamanan pasien, kami mohon Anda dapat melakukan kunjungan sesuai dengan ketentuan berikut:</p>
                </div>
                
                <div class="row g-4 justify-content-center mb-5">
                    <!-- Senin - Sabtu -->
                    <div class="col-md-5">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center bg-white">
                            <div class="icon-circle mx-auto mb-3 text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #008fd7;">
                                <i class="fa-solid fa-calendar-day fs-3"></i>
                            </div>
                            <h4 class="fw-bold mb-4">Senin – Sabtu</h4>
                            <div class="d-flex justify-content-between align-items-center px-4 mb-2">
                                <span class="text-muted"><i class="fa-regular fa-sun text-warning me-2"></i> Pagi</span>
                                <span class="fw-medium">09.30 – 11.00</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center px-4">
                                <span class="text-muted"><i class="fa-solid fa-cloud-sun text-info me-2"></i> Sore</span>
                                <span class="fw-medium">17.00 – 18.30</span>
                            </div>
                        </div>
                    </div>
                    <!-- Minggu & Hari Libur -->
                    <div class="col-md-5">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center bg-white">
                            <div class="icon-circle mx-auto mb-3 text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #008fd7;">
                                <i class="fa-regular fa-calendar-check fs-3"></i>
                            </div>
                            <h4 class="fw-bold mb-4">Minggu & Hari Libur</h4>
                            <div class="d-flex justify-content-between align-items-center px-4 mb-2">
                                <span class="text-muted"><i class="fa-regular fa-sun text-warning me-2"></i> Pagi</span>
                                <span class="fw-medium">09.30 – 11.30</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center px-4">
                                <span class="text-muted"><i class="fa-solid fa-cloud-sun text-info me-2"></i> Sore</span>
                                <span class="fw-medium">16.30 – 18.30</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KETENTUAN PENGUNJUNG -->
                <div class="section-heading text-center mb-5 mt-5">
                    <h2 class="d-inline-block position-relative pb-2 border-bottom border-primary border-2">Ketentuan Pengunjung</h2>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card border-0 shadow-sm rounded-4 p-2 mb-3 bg-white">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-heart-pulse fs-5"></i>
                                </div>
                                <p class="mb-0 text-muted">Demi Kesehatan Anda, kami menyarankan untuk <strong>tidak melakukan kunjungan</strong> terlebih dahulu apabila kondisi badan sedang tidak fit.</p>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm rounded-4 p-2 mb-3 bg-white">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-volume-xmark fs-5"></i>
                                </div>
                                <p class="mb-0 text-muted">Mohon untuk <strong>tidak berbicara keras</strong> dan berkunjung secara bergantian (<strong>maksimal 2 pengunjung</strong> untuk tiap pasien).</p>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm rounded-4 p-2 mb-4 bg-white">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-4 flex-shrink-0" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-child-reaching fs-5"></i>
                                </div>
                                <p class="mb-0 text-muted">Anak-anak <strong>di bawah usia 12 tahun</strong> tidak diizinkan berkunjung.</p>
                            </div>
                        </div>
                        <div class="text-center mt-5 text-muted fst-italic">
                            <p>Terima kasih atas kesediaan Anda dalam membantu kami menjaga ketenangan dan kenyamanan pasien selama di rawat di Rumah Sakit St. Elisabeth Semarang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
                            <li class="footer-list"><a href="{{{ route('tentang-kami.index') }}}"><i class="fa-solid fa-caret-right"></i> Tentang Kami</a></li>
                            <li class="footer-list"><a href="{{{ route('news.index') }}}"><i class="fa-solid fa-caret-right"></i> Elisanews</a></li>
                            <li class="footer-list"><a href="#"><i class="fa-solid fa-caret-right"></i> Hubungi Kami</a></li>
                            <li class="footer-list"><a href="{{{ route('glossary.index') }}}"><i class="fa-solid fa-caret-right"></i> Perpustakaan Online</a></li>
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

    <a href="tel:+62248502244" class="floating-emergency text-decoration-none text-white"
        title="Emergency Call (024) 8502244">
        <i class="fa-solid fa-truck-medical"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/726e331ad1.js" crossorigin="anonymous"></script>
    @vite([
        'resources/js/navbar/navbar.js',
        'resources/js/navbar/navbar-dropdown.js'
    ])
</body>
</html>
