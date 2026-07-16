<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kumpulan Paket dan Promo Menarik dari RS St. Elisabeth Semarang.">
    <title>Promotions - RS St. Elisabeth Semarang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite([
        'resources/js/navbar/navbar.js',
        'resources/js/navbar/navbar-dropdown.js',
        'resources/js/promotions/promotions.js',
        'resources/css/style.css',
        'resources/css/glossarium.css',
        'resources/css/navbar-dropdown.css'
    ])
</head>
<body>
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
                        <a class="nav-link" href="#">Fasilitas</a>
                    </li>
                    <li class="nav-item nav-paket-dan-promo">
                        <a class="nav-link active" aria-current="page" href="{{ route('getPromotions') }}">Paket dan Promo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>
        <section id="hero-section">
            <div class="container">
                <!-- Breadcrumb -->
                <nav class="hero-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb flex-wrap">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Promo dan Penawaran</li>
                    </ol>
                </nav>

                <div class="row">
                    <!-- Kolom kiri: Judul, subjudul -->
                    <div class="col-12 col-lg-8">
                        <h1 class="hero-title">Promo & Penawaran Spesial</h1>
                        <p class="hero-subtitle">Temukan penawaran menarik layanan kesehatan unggulan dari RS St. Elisabeth Semarang.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="promotions-list">
            <div class="container py-5">
                <div class="row cards">
                    @foreach ($request as $data)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" 
                                 data-bs-toggle="modal" data-bs-target="#promoModal"
                                 data-title="{{ $data['judul'] ?? $data['deskripsi'] }}"
                                 data-desc="{{ $data['deskripsi'] ?? 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, maxime.' }}"
                                 data-img="data:image/jpeg;base64,{{ $data['gambar'] }}"
                                 style="cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)';">
                                <img src="data:image/jpeg;base64,{{ $data['gambar'] }}" class="card-img-top" alt="Promotion" style="height: 300px; object-fit: contain; background-color: #f8f9fa;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-primary mb-3" style="text-transform: capitalize">{{ $data['judul'] ?? $data['deskripsi'] }}</h5>
                                    <p class="card-text text-muted flex-grow-1">{{ $data['deskripsi'] ?? 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, maxime.' }}</p>
                                    <div class="mt-4">
                                        <a href="https://wa.me/6281234567890?text={{ urlencode('Halo, saya ingin memesan promo ' . ($data['judul'] ?? $data['deskripsi'])) }}" target="_blank" class="btn btn-success w-100 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center">
                                            <i class="fa-brands fa-whatsapp fs-5 me-2"></i> Pesan Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Dummy data -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" 
                             data-bs-toggle="modal" data-bs-target="#promoModal"
                             data-title="Promo MCU Jantung"
                             data-desc="Medical Check Up khusus Jantung dengan fasilitas lengkap dan ditangani oleh spesialis terbaik."
                             data-img="{{ asset('images/ADS1749518930.jpg') }}"
                             style="cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)';">
                            <img src="{{ asset('images/ADS1749518930.jpg') }}" class="card-img-top" alt="Promo MCU Jantung" style="height: 300px; object-fit: contain; background-color: #f8f9fa;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-3">Promo MCU Jantung</h5>
                                <p class="card-text text-muted flex-grow-1">Medical Check Up khusus Jantung dengan fasilitas lengkap dan ditangani oleh spesialis terbaik.</p>
                                <div class="mt-4">
                                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20memesan%20Promo%20MCU%20Jantung" target="_blank" class="btn btn-success w-100 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center">
                                        <i class="fa-brands fa-whatsapp fs-5 me-2"></i> Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" 
                             data-bs-toggle="modal" data-bs-target="#promoModal"
                             data-title="Screening Gula Darah"
                             data-desc="Pemeriksaan gula darah rutin untuk deteksi dini diabetes. Jangan abaikan kesehatan Anda."
                             data-img="{{ asset('images/ADS1749518080.jpeg') }}"
                             style="cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)';">
                            <img src="{{ asset('images/ADS1749518080.jpeg') }}" class="card-img-top" alt="Screening Gula Darah" style="height: 300px; object-fit: contain; background-color: #f8f9fa;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-3">Screening Gula Darah</h5>
                                <p class="card-text text-muted flex-grow-1">Pemeriksaan gula darah rutin untuk deteksi dini diabetes. Jangan abaikan kesehatan Anda.</p>
                                <div class="mt-4">
                                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20memesan%20Screening%20Gula%20Darah" target="_blank" class="btn btn-success w-100 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center">
                                        <i class="fa-brands fa-whatsapp fs-5 me-2"></i> Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" 
                             data-bs-toggle="modal" data-bs-target="#promoModal"
                             data-title="Paket Persalinan Nyaman"
                             data-desc="Sambut kelahiran buah hati dengan tenang bersama paket persalinan eksklusif dari RS St. Elisabeth."
                             data-img="{{ asset('images/ADS1758074522.jpeg') }}"
                             style="cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)';">
                            <img src="{{ asset('images/ADS1758074522.jpeg') }}" class="card-img-top" alt="Paket Persalinan Nyaman" style="height: 300px; object-fit: contain; background-color: #f8f9fa;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-3">Paket Persalinan Nyaman</h5>
                                <p class="card-text text-muted flex-grow-1">Sambut kelahiran buah hati dengan tenang bersama paket persalinan eksklusif dari RS St. Elisabeth.</p>
                                <div class="mt-4">
                                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20memesan%20Paket%20Persalinan%20Nyaman" target="_blank" class="btn btn-success w-100 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center">
                                        <i class="fa-brands fa-whatsapp fs-5 me-2"></i> Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Promotion -->
            <div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3 bg-white p-2 rounded-circle shadow-sm" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.9;"></button>
                        <div class="modal-body p-0">
                            <div class="row g-0">
                                <!-- Bagian Kiri: Gambar Promo -->
                                <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
                                    <img src="" id="promoModalImg" class="img-fluid w-100 h-100" style="object-fit: contain; max-height: 85vh;" alt="Promo">
                                </div>
                                <!-- Bagian Kanan: Detail Promo -->
                                <div class="col-md-6 p-4 p-md-5 d-flex flex-column justify-content-center bg-white">
                                    <h6 class="text-uppercase fw-bold mb-2" style="color: var(--secondary-color); letter-spacing: 1px;">Info Spesial</h6>
                                    <h2 id="promoModalTitle" class="fw-bold mb-4" style="color: var(--primary-color);"></h2>
                                    <p id="promoModalDesc" class="text-secondary fs-5 lh-base mb-5"></p>
                                    
                                    <div class="mt-auto border-top pt-4">
                                        <p class="text-muted fw-semibold mb-3">Dapatkan penawaran ini sekarang!</p>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-sm d-flex align-items-center flex-grow-1 justify-content-center">
                                                <i class="fa-brands fa-whatsapp fs-5 me-2"></i> Hubungi Kami
                                            </a>
                                            <button type="button" class="btn btn-light px-4 py-2 rounded-pill fw-semibold flex-grow-0" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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