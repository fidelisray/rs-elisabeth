{{-- {{ dd($glossary); }} --}}

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kamus Medis</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        @vite([
            'resources/js/navbar/navbar.js',
            'resources/js/glosarium/glosarium.js',
            'resources/css/style.css',
            'resources/css/hero.css',
            'resources/css/glossarium.css',
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
        <section id="hero-section">



        
            <div class="container">

                <!-- Breadcrumb -->
                <nav class="hero-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb flex-wrap">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('glossary.index') }}">Kamus Medis</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $item['istilah'] ?? '' }}</li>
                    </ol>
                </nav>

                <div class="row">
                    <!-- Kolom kiri: Judul, subjudul, search -->
                    <div class="col-12 col-lg-6">
                        <h1 class="hero-title">Glossary of Health Coverage and Medical Terms</h1>
                        <p class="hero-subtitle">Easy-to-understand answers about Health and Medical Terms</p>

                        <p class="search-label">Search diseases &amp; conditions</p>
                        {{-- <div class="search-box d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                            <form id="glossarySearchForm" role="search" autocomplete="off" onsubmit="return false;">
                                <input
                                    type="text"
                                    id="glossarySearchInput"
                                    name="q"
                                    class="form-control"
                                    placeholder="Cari istilah medis..."
                                    minlength="2"
                                    autocomplete="off"
                                >
                            </form>
                        </div> --}}


                        <div class="search-box d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                            <form id="glossarySearchForm" role="search" autocomplete="off" class="d-flex w-100 align-items-center gap-2">
                                <input
                                    type="text"
                                    id="glossarySearchInput"
                                    name="q"
                                    class="form-control"
                                    placeholder="Cari istilah medis..."
                                    minlength="2"
                                    autocomplete="off"
                                >
                                <button type="button" id="resetSearchBtn" class="btn btn-outline-danger" style="display: none;">
                                    Reset
                                </button>
                            </form>
                        </div>



                    </div>
                    
                    <!-- Kolom kanan: Grid huruf A-Z -->
                    {{-- <div class="col-12 col-lg-6 mt-4 mt-lg-0 d-flex flex-column align-items-start align-items-lg-end">
                        <div class="letter-panel-label">Find diseases &amp; conditions by first letter</div>
                            <div class="letter-grid">
                                @foreach(range('A', 'Z') as $letter)
                                    @php $hasItems = in_array($letter, $availableLetters); @endphp
                                    <a href="{{ $hasItems ? route('glossary.index', ['letter' => $letter]) : '#' }}"
                                    class="letter-btn
                                        {{ $activeLetter === $letter ? 'active' : (!$hasItems ? 'btn-muted' : '') }}"
                                        {{ !$hasItems ? 'aria-disabled=true' : '' }}>
                                        {{ $letter }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        
        
        <section class="glosarium-detail bg-light py-5">
            <div class="container">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="title mb-4 fw-bold" style="color: #0b5c96;">
                            {{ $item['istilah'] ?? 'Istilah Tidak Ditemukan' }}
                        </h1>
                        <hr class="mb-4">
                        <div class="deskripsi-text fs-5 text-secondary" style="line-height: 1.8;">
                            {{ $item['deskripsi'] ?? 'Deskripsi tidak tersedia untuk istilah ini.' }}
                        </div>
                        
                        <div class="mt-5">
                            <a href="{{ route('glossary.index') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Kamus Medis
                            </a>
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
            'resources/js/glosarium/glosarium.js',
        ])
    </body>
</html>