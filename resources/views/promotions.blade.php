<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Promotions</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        @vite([
            'resources/js/navbar/navbar.js',
            'resources/css/style.css',
            'resources/css/hero.css',
        ])
    </head>
    <body>
        <header class="nav-group">
            <nav class="navbar bg-body-tertiary">
                <div class="container d-flex">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="auto" height="70" class="d-inline-block align-text-top">
                        <img src="{{ asset('images/akreditasi.png') }}" alt="Logo" width="auto" height="70" class="d-inline-block align-text-top">
                    </a>
                    <form class="d-flex nav-form-search" role="search">
                        <input class="form-control me-2" type="search" placeholder="Temukan dokter, klinik, jadwal.." aria-label="Search"/>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <a href="#" class="navbar-brand ambulance-call">
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
                <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="navbar-nav nav-content gap-2">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item dropdown">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cari Dokter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ruang Perawatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Fasilitas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Paket dan Promo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section id="hero" class="container-fluid d-flex align-items-center justify-content-center">
            <div class="text-center">
                <!-- <img class="d-block mx-auto mb-4" src="https://getbootstrap.com" alt="Logo" width="72" height="57"> -->
                <div class="hero-img">
                    <i class="fa-solid fa-tags tags-icon"></i>
                </div>
                <div class="hero-header container-fluid">
                    <h1 class="display-5 fw-bold text-body-emphasis">Promo dan Penawaran</h1>
                </div>
                <div class="col-lg-6 mx-auto">
                    {{-- <p class="lead mb-4">Tim Dokter Berpengalaman kami akan selalu siap sedia untuk memberikan pelayanan kesehatan terbaik dan professional untuk anda dan keluarga</p> --}}
                    <!-- <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
                    </div> -->
                </div>
            </div>
        </section>
        <section id="promotions">
            <div class="title text-center">
                <h2 class="display-8 fw-bold section-title">Paket dan Promo</h2>
            </div>
            <div class="container py-5">
                <div class="row cards">
                    @foreach ($request as $data)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                                <img src="data:image/jpeg;base64,{{ $data['gambar'] }}" class="card-img" alt="Promotion">
                                <div class="card-body">
                                    <h5 class="card-text" style="text-transform: capitalize">{{ $data['deskripsi'] }}</h5>
                                    <p class="card-description">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, maxime.</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                            <img src="{{ asset('images/ADS1749518930.jpg') }}" class="card-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">Promotion Title</h5>
                                <p class="card-description">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            </div>
                        </div>
                    </div>    
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                            <img src="{{ asset('images/ADS1749518080.jpeg') }}" class="card-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">Promotion Title</h5>
                                <p class="card-description">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            </div>
                        </div>
                    </div>    
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                            <img src="{{ asset('images/ADS1758074522.jpeg') }}" class="card-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">Promotion Title</h5>
                                <p class="card-description">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            </div>
                        </div>
                    </div>    
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                            <img src="{{ asset('images/ADS1758075145.jpeg') }}" class="card-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">Promotion Title</h5>
                                <p class="card-description">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                            <img src="{{ asset('images/ADS1761805772.jpeg') }}" class="card-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">Promotion Title</h5>
                                <p class="card-description">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                            <img src="{{ asset('images/ADS1761805889.jpeg') }}" class="card-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">Promotion Title</h5>
                                <p class="card-description">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="footer" class="pt-5">
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
                                <li><a href="https://play.google.com/store/apps/details?id=com.elisameds.app"><i class="fa-brands fa-google-play"></i></a></li>
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
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/726e331ad1.js" crossorigin="anonymous"></script>
        @vite([
            'resources/js/navbar/navbar.js',
        ])
    </body>
</html>