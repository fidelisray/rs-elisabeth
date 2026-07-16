<!doctype html>
<html lang="id">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="Rumah Sakit St. Elisabeth Semarang memberikan pelayanan kesehatan terbaik, profesional, terakreditasi Paripurna KARS, dengan layanan IGD 24 Jam dan Stroke Terpadu.">
      <title>St. Elisabeth Hospital</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      @vite([
        'resources/css/style.css',
        'resources/css/navbar-dropdown.css'
      ])
  </head>
  <body>
    <header class="nav-group">
        <nav class="navbar bg-body-tertiary">
            <div class="container d-flex">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo RS St. Elisabeth Semarang" width="auto" height="70" class="d-inline-block align-text-top">
                    <img src="{{ asset('images/akreditasi.png') }}" alt="Logo RS St. Elisabeth Semarang" width="auto" height="70" class="d-inline-block align-text-top">
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
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                <ul class="navbar-nav nav-content gap-2">
                    <li class="nav-item nav-beranda">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
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
                        <a class="nav-link" href="{{ route('promotions.index') }}">Paket dan Promo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <h1 class="visually-hidden">Rumah Sakit Santa Elisabeth Semarang</h1>
        <section id="hero">
            <div class="carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 7"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/lp-web-01.jpg') }}" class="d-block w-100" alt="Banner Promo RS St. Elisabeth 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lp-web-02.jpg') }}" class="d-block w-100" alt="Banner Promo RS St. Elisabeth 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lp-web-03.jpg') }}" class="d-block w-100" alt="Banner Promo RS St. Elisabeth 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lp-web-04.jpg') }}" class="d-block w-100" alt="Banner Promo RS St. Elisabeth 4">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lp-web-05.jpg') }}" class="d-block w-100" alt="Banner Promo RS St. Elisabeth 5">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lp-web-06.jpg') }}" class="d-block w-100" alt="Banner Promo RS St. Elisabeth 6">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lp-web-07.jpg') }}" class="d-block w-100" alt="Banner Promo RS St. Elisabeth 7">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <section id="quick-access" class="pb-5">
            <div class="container">
                <div class="row g-0 options-cards">
                    <div class="col-md-3 card-options">
                        <a href="{{ route('dokter.index') }}" class="text-decoration-none">
                            <div class="card h-100 border-0 rounded-0">
                                <div class="card-body d-flex text-center align-items-center justify-content-center">
                                    <i class="fa-solid fa-user-doctor doctor-icon"></i>
                                    <p class="mt-2">Cari Dokter</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 card-options">
                        <a href="#" class="text-decoration-none">
                            <div class="card h-100 border-0 rounded-0">
                                <div class="card-body d-flex text-center align-items-center justify-content-center">
                                    <i class="fa-regular fa-calendar appointment-icon"></i>
                                    <p class="mt-2">Buat Janji Temu</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 card-options">
                        <a href="#" class="text-decoration-none">
                            <div class="card h-100 border-0 rounded-0">
                                <div class="card-body d-flex text-center align-items-center justify-content-center">
                                    <i class="fa-brands fa-whatsapp whatsapp-icon"></i>
                                    <p class="mt-2">Hubungi Kami</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 card-options">
                        <a href="{{ route('glossary.index') }}" class="text-decoration-none">
                            <div class="card h-100 border-0 rounded-0">
                                <div class="card-body d-flex text-center align-items-center justify-content-center">
                                    <i class="fa-solid fa-book-medical glossary-icon"></i>
                                    <div class="mt-1">
                                        <p class="my-0">Kamus Medis</p>
                                        {{-- <p class="my-0">(024) 850-22-44</p> --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-us container-fluid">
            <div class="container p-2 mb-4 rounded-3">
                <div class="title text-center section-title">
                    <h2 class="display-8 fw-bold">Percayakan Kesehatan Anda Bersama Kami</h2>
                </div>
                <div class="py-5 row">
                    <div class="about-content px-5 col-md-5">
                        <div class="about-rs">
                            <h3>Terakreditasi Paripurna</h3>
                            <p>Kami mendapat predikat PARIPURNA dari Komisi Akreditasi Rumah Sakit (KARS), yang merupakan predikat dengan hasil penilaian tertinggi berdasarkan penilaian terhadap manajemen mutu dan keselamatan pasien yang diterapkan di Rumah Sakit.</p>
                        </div>
                        <div class="about-rs">
                            <h3>Layanan 24 Jam</h3>
                            <p>Kami menyediakan layanan 24 jam untuk memenuhi kebutuhan Kesehatan anda, khususnya bagi anda yang membutuhkan penanganan emergency.</p>
                        </div>
                        <div class="about-rs">
                            <h3>Service Excellent</h3>
                            <p>Berpusat kepada pasien sebagai “Tamu Ilahi”, Kami senantiasa memberikan kualitas pelayanan yang bermutu tinggi dan profesional, dengan tetap memperhatikan aspek keselamatan pasien.</p>
                        </div>
                    </div>
                    <div class="jumbotron-image col-md-7 text-center">
                        <img src="{{ asset('images/feature.jpg') }}" class="img-fluid rounded shadow" alt="Fasilitas RS St. Elisabeth Semarang" srcset="">
                    </div>
                </div>
            </div>
        </section>
        <section id="facilities-and-services">
            <!-- <h2 class="tittle text-align-center">Our Speciality</h2> -->
            <div class="title text-center">
                <h2 class="display-8 fw-bold section-title">Fasilitas dan Layanan</h2>
            </div>
            <div class="container-fluid py-5">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                    </div>
                    <div class="carousel-inner" id="carousel-facilities-and-services">
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row align-items-center gy-4">
                                    <div class="col-md-6">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('images/F1670220299.jpg') }}" class="img-fluid" alt="Fasilitas Spesialisasi RS St. Elisabeth">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <span class="badge bg-primary mb-3"> -->
                                        <span class="mb-3">Featured</span>
                                        <h3 class="fw-bold">Pelayanan Stroke Terpadu</h3>
                                        <p class="text-muted">
                                            Comprehensive medical services
                                            for Stroke patients.
                                        </p>
                                        <div class="mt-4">
                                            <a href="#" class="btn-learn" aria-label="Pelajari lebih lanjut">Learn More ></a>
                                            <!-- <a href="#"
                                            class="btn btn-outline-primary">
                                                Contact Us
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row align-items-center gy-4">
                                    <div class="col-md-6">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('images/F1670914854.jpg') }}" class="img-fluid" alt="Fasilitas Spesialisasi RS St. Elisabeth">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <span class="badge bg-primary mb-3"> -->
                                        <span class="mb-3">Featured</span>
                                        <h3 class="fw-bold">Klinik Nyeri</h3>
                                        <p class="text-muted">
                                            Comprehensive medical services
                                            for Stroke patients. Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis praesentium velit atque dolore, reprehenderit tempore. Illo itaque dolores assumenda quia?
                                        </p>
                                        <div class="mt-4">
                                            <a href="#" class="btn-learn" aria-label="Pelajari lebih lanjut">Learn More ></a>
                                            <!-- <a href="#"
                                            class="btn btn-outline-primary">
                                                Contact Us
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row align-items-center gy-4">
                                    <div class="col-md-6">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('images/F1670914872.jpg') }}" class="img-fluid" alt="Fasilitas Spesialisasi RS St. Elisabeth">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <span class="badge bg-primary mb-3"> -->
                                        <span class="mb-3">Featured</span>
                                        <h3 class="fw-bold">Pelayanan Neurofisiologi</h3>
                                        <p class="text-muted">
                                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis deserunt consectetur quos neque eius dicta possimus numquam autem beatae nam.
                                        </p>
                                        <div class="mt-4">
                                            <a href="#" class="btn-learn" aria-label="Pelajari lebih lanjut">Learn More ></a>
                                            <!-- <a href="#"
                                            class="btn btn-outline-primary">
                                                Contact Us
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row align-items-center gy-4">
                                    <div class="col-md-6">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('images/F1671680565.jpg') }}" class="img-fluid" alt="Fasilitas Spesialisasi RS St. Elisabeth">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <span class="badge bg-primary mb-3"> -->
                                        <span class="mb-3">Featured</span>
                                        <h3 class="fw-bold">Pelayanan Gawat Darurat</h3>
                                        <p class="text-muted">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste eius illum excepturi pariatur, dicta maiores, voluptas veniam quisquam, cupiditate hic consectetur adipisci ducimus repellendus officiis. Aliquid iure magnam atque iusto?
                                        </p>
                                        <div class="mt-4">
                                            <a href="#" class="btn-learn" aria-label="Pelajari lebih lanjut">Learn More ></a>
                                            <!-- <a href="#"
                                            class="btn btn-outline-primary">
                                                Contact Us
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row align-items-center gy-4">
                                    <div class="col-md-6">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('images/F1671680579.jpg') }}" class="img-fluid" alt="Fasilitas Spesialisasi RS St. Elisabeth">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <span class="badge bg-primary mb-3"> -->
                                        <span class="mb-3">Featured</span>
                                        <h3 class="fw-bold">Ruang Rawat Intensif</h3>
                                        <p class="text-muted">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum distinctio iste, aut, magnam inventore dolorem labore ducimus, unde saepe ratione a aliquid error atque magni! Ratione maiores sequi vitae aspernatur aliquam ullam dignissimos accusamus fuga.
                                        </p>
                                        <div class="mt-4">
                                            <a href="#" class="btn-learn" aria-label="Pelajari lebih lanjut">Learn More ></a>
                                            <!-- <a href="#"
                                            class="btn btn-outline-primary">
                                                Contact Us
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row align-items-center gy-4">
                                    <div class="col-md-6">
                                        <div class="img-wrapper">
                                            <img src="{{ asset('images/F1671680659.jpg') }}" class="img-fluid" alt="Fasilitas Spesialisasi RS St. Elisabeth">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <span class="badge bg-primary mb-3"> -->
                                        <span class="mb-3">Featured</span>
                                        <h3 class="fw-bold">Klinik Spesialis dan Gigi</h3>
                                        <p class="text-muted">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum eos quaerat debitis odit? Qui, architecto?
                                        </p>
                                        <div class="mt-4">
                                            <a href="#" class="btn-learn" aria-label="Pelajari lebih lanjut">Learn More ></a>
                                            <!-- <a href="#"
                                            class="btn btn-outline-primary">
                                                Contact Us
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-rse" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-rse" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <section id="promotions" class="position-relative">
            <div class="title text-center mb-5">
                <h2 class="display-8 fw-bold section-title">Paket dan Promo</h2>
                {{-- <p class="text-muted">Temukan penawaran terbaik untuk layanan kesehatan Anda</p> --}}
            </div>
            <div class="container pb-5">
                <div class="promo-track" id="promoTrack">
                    <div class="promo-card" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Promo MCU Jantung" data-desc="Medical Check Up khusus Jantung dengan fasilitas lengkap dan ditangani oleh spesialis terbaik. Promo berlaku hingga akhir bulan ini." data-img="{{ asset('images/ADS1749518930.jpg') }}">
                        <div class="card h-100">
                            <img src="{{ asset('images/ADS1749518930.jpg') }}" class="card-img-top" alt="Paket MCU Jantung">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-2">Promo MCU Jantung</h5>
                                <p class="card-text text-muted small flex-grow-1">Pemeriksaan fungsi jantung secara komprehensif dengan harga spesial.</p>
                                <div class="mt-3 text-end">
                                    <span class="text-secondary fw-semibold small">Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="promo-card" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Screening Gula Darah" data-desc="Pemeriksaan gula darah rutin untuk deteksi dini diabetes. Jangan abaikan kesehatan Anda." data-img="{{ asset('images/ADS1749518080.jpeg') }}">
                        <div class="card h-100">
                            <img src="{{ asset('images/ADS1749518080.jpeg') }}" class="card-img-top" alt="Screening Gula Darah">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-2">Screening Gula Darah</h5>
                                <p class="card-text text-muted small flex-grow-1">Deteksi dini risiko diabetes dengan paket screening terjangkau.</p>
                                <div class="mt-3 text-end">
                                    <span class="text-secondary fw-semibold small">Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="promo-card" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Paket Persalinan Nyaman" data-desc="Sambut kelahiran buah hati dengan tenang bersama paket persalinan eksklusif dari RS St. Elisabeth." data-img="{{ asset('images/ADS1758074522.jpeg') }}">
                        <div class="card h-100">
                            <img src="{{ asset('images/ADS1758074522.jpeg') }}" class="card-img-top" alt="Paket Persalinan">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-2">Paket Persalinan Nyaman</h5>
                                <p class="card-text text-muted small flex-grow-1">Layanan persalinan VIP dengan fasilitas terbaik untuk ibu dan anak.</p>
                                <div class="mt-3 text-end">
                                    <span class="text-secondary fw-semibold small">Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="promo-card" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Promo Vaksinasi Influenza" data-desc="Lindungi diri dan keluarga dari virus influenza dengan vaksin berstandar internasional." data-img="{{ asset('images/ADS1758075145.jpeg') }}">
                        <div class="card h-100">
                            <img src="{{ asset('images/ADS1758075145.jpeg') }}" class="card-img-top" alt="Vaksinasi Influenza">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-2">Vaksinasi Influenza</h5>
                                <p class="card-text text-muted small flex-grow-1">Dapatkan perlindungan maksimal dari influenza musim ini.</p>
                                <div class="mt-3 text-end">
                                    <span class="text-secondary fw-semibold small">Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="promo-card" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Screening Kanker Serviks" data-desc="Pemeriksaan papsmear dan konsultasi obgyn dengan harga diskon khusus bulan ini." data-img="{{ asset('images/ADS1761805772.jpeg') }}">
                        <div class="card h-100">
                            <img src="{{ asset('images/ADS1761805772.jpeg') }}" class="card-img-top" alt="Screening Kanker Serviks">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-2">Screening Kanker Serviks</h5>
                                <p class="card-text text-muted small flex-grow-1">Lakukan papsmear berkala demi kesehatan reproduksi Anda.</p>
                                <div class="mt-3 text-end">
                                    <span class="text-secondary fw-semibold small">Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="promo-card" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Promo Fisioterapi" data-desc="Atasi nyeri sendi dan tulang dengan layanan fisioterapi kami yang menggunakan teknologi terkini." data-img="{{ asset('images/ADS1761805889.jpeg') }}">
                        <div class="card h-100">
                            <img src="{{ asset('images/ADS1761805889.jpeg') }}" class="card-img-top" alt="Promo Fisioterapi">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary mb-2">Promo Fisioterapi</h5>
                                <p class="card-text text-muted small flex-grow-1">Paket 5x sesi fisioterapi untuk pemulihan cedera olahraga.</p>
                                <div class="mt-3 text-end">
                                    <span class="text-secondary fw-semibold small">Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i></span>
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

            <div class="text-center mt-5 mb-3">
                <a href="{{ route('promotions.index') }}" class="btn btn-bouncing px-5 py-3 rounded-pill fw-bold shadow-lg" aria-label="Lihat Penawaran Menarik Lainnya">
                    Lihat Penawaran Menarik Lainnya <i class="fa-solid fa-arrow-down ms-2"></i>
                </a>
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
    @vite([
        'resources/js/navbar/navbar.js',
        'resources/js/navbar/navbar-dropdown.js',
        'resources/js/promotions/promotions.js'
    ])
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Hospital",
      "name": "RS St. Elisabeth Semarang",
      "image": "{{ asset('images/logo.png') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "(024) 8502244",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Jl. Kawi No.1",
        "addressLocality": "Semarang",
        "addressRegion": "Jawa Tengah",
        "postalCode": "50252",
        "addressCountry": "ID"
      }
    }
    </script>
  </body>
</html>