{{ dd($glossary); }}

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kamus Medis</title>
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
                    <i class="fa-solid fa-book-medical tags-icon"></i>
                </div>
                <div class="hero-header container-fluid">
                    <h1 class="display-5 fw-bold text-body-emphasis">Kamus Medis</h1>
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
        <section id="promotions"> {{-- change the id name later --}}
            <div class="title text-center">
                <h2 class="display-8 fw-bold section-title">Kamus Medis</h2>
            </div>
            <div class="container py-5">
                <section class="content-header">
                    {{-- Navigasi A-Z --}}
                    <div class="d-flex flex-wrap gap-1 mb-4">
                        <a href="{{ route('glossary.index') }}"
                        class="btn btn-sm {{ $activeLetter === 'ALL' ? 'btn-primary' : 'btn-outline-secondary' }}">
                            Semua
                        </a>

                        @foreach(range('A', 'Z') as $letter)
                            @php $hasItems = in_array($letter, $availableLetters); @endphp
                            <a href="{{ $hasItems ? route('glossary.index', ['letter' => $letter]) : '#' }}"
                            class="btn btn-sm
                                {{ $activeLetter === $letter ? 'btn-primary' : ($hasItems ? 'btn-outline-secondary' : 'btn-outline-light text-muted') }}"
                            {{ !$hasItems ? 'aria-disabled=true' : '' }}>
                                {{ $letter }}
                            </a>
                        @endforeach
                    </div>
                </section>
                <section class="content-body">
                    {{-- Daftar Istilah --}}
                    {{-- @forelse($glossary as $item)
                        <div class="card mb-2 border-0 shadow-sm">
                            <div class="card-body py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 text-primary">{{ $item['istilah'] }}</h5>
                                        <p class="mb-0 text-muted small">{{ Str::limit($item['deskripsi'], 180) }}</p>
                                    </div>
                                    <a href="{{ route('glossary.show', urlencode($item['istilah'])) }}"
                                    class="btn btn-sm btn-outline-primary ms-3 flex-shrink-0">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            Tidak ada istilah medis untuk huruf <strong>{{ $activeLetter }}</strong>.
                        </div>
                    @endforelse --}}


                    {{-- Daftar Istilah (dikelompokkan per 2 huruf) --}}
                    @if(count($glossary) > 0)
                        @foreach($glossary as $prefix => $items)

                            {{-- Header grup: "Ba", "Bi", "Ca", dst --}}
                            <h4 class="fw-bold mt-4 mb-2 border-bottom pb-1">{{ $prefix }}</h4>

                            @foreach($items as $item)
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <a href="{{ route('glossary.show', urlencode($item['istilah'])) }}"
                                    class="text-decoration-none text-dark fs-6">
                                        {{ $item['istilah'] }}
                                    </a>
                                </div>
                            @endforeach

                        @endforeach
                    @else
                        <div class="alert alert-info mt-3">
                            Tidak ada istilah medis untuk huruf <strong>{{ $activeLetter }}</strong>.
                        </div>
                    @endif
                </section>
                {{-- <div class="row cards">
                    @forelse ($glossary as $glosarium)
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body row">
                                    <div class="col-12">
                                        <h5 class="card-text" style="text-transform: capitalize">{{ $glosarium['istilah'] }}</h5>
                                        <p class="mb-0 text-muted small card-description">{{ Str::limit($glosarium['deskripsi'], 180) }}</p>
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ route('glossary.show', urlencode($glosarium['istilah'])) }}"
                                        class="btn btn-sm btn-outline-primary w-100">
                                            Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            Tidak ada istilah medis untuk huruf <strong>{{ $activeLetter }}</strong>.
                        </div>
                    @endforelse
                </div> --}}
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