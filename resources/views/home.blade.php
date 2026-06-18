<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>RS St. Elisabeth</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      @vite([
        'resources/css/style.css',
      ])
  </head>
  <body>
    <header>
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
                <div class="dropdown">
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
        <nav class="navbar navbar-expand-lg second-nav">
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
    </header>
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
                        <img src="{{ asset('images/lp-web-01.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/lp-web-02.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/lp-web-03.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/lp-web-04.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/lp-web-05.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/lp-web-06.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/lp-web-07.jpg') }}" class="d-block w-100" alt="...">
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
            <div class="row g-0 cards">
                <div class="col-md-3">
                    <a href="/dokter" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-0">
                            <div class="card-body d-flex text-center align-items-center justify-content-center">
                                <i class="fa-solid fa-user-doctor doctor-icon"></i>
                                <p class="mt-2">Cari Dokter</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-0">
                            <div class="card-body d-flex text-center align-items-center justify-content-center">
                                <i class="fa-regular fa-calendar appointment-icon"></i>
                                <p class="mt-2">Buat Janji Temu</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-0">
                            <div class="card-body d-flex text-center align-items-center justify-content-center">
                                <i class="fa-brands fa-whatsapp whatsapp-icon"></i>
                                <p class="mt-2">Hubungi Kami</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-0">
                            <div class="card-body d-flex text-center align-items-center justify-content-center">
                                <i class="fa-solid fa-briefcase-medical emergency-call"></i>
                                <div class="mt-1">
                                    <p class="my-0">Emergency Call</p>
                                    <p class="my-0">(024) 850-22-44</p>
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
                <h2 class="display-8 fw-bold">Why People Choose Us?</h2>
            </div>
            <div class="py-5 row">
                <div class="about-content px-5 col-md-5">
                    <div class="about-rs">
                        <h4>Terakreditasi Paripurna</h4>
                        <p>Kami mendapat predikat PARIPURNA dari Komisi Akreditasi Rumah Sakit (KARS), yang merupakan predikat dengan hasil penilaian tertinggi berdasarkan penilaian terhadap manajemen mutu dan keselamatan pasien yang diterapkan di Rumah Sakit.</p>
                    </div>
                    <div class="about-rs">
                        <h4>Layanan 24 Jam</h4>
                        <p>Kami menyediakan layanan 24 jam untuk memenuhi kebutuhan Kesehatan anda, khususnya bagi anda yang membutuhkan penanganan emergency.</p>
                    </div>
                    <div class="about-rs">
                        <h4>Service Excellent</h4>
                        <p>Berpusat kepada pasien sebagai “Tamu Ilahi”, Kami senantiasa memberikan kualitas pelayanan yang bermutu tinggi dan profesional, dengan tetap memperhatikan aspek keselamatan pasien.</p>
                    </div>
                </div>
                <div class="jumbotron-image col-md-7 text-center">
                    <img src="{{ asset('images/feature.jpg') }}" class="img-fluid rounded shadow" alt="" srcset="">
                </div>
            </div>
        </div>
    </section>
    <section class="our-speciality">
        <!-- <h2 class="tittle text-align-center">Our Speciality</h2> -->
         <div class="title text-center">
            <h2 class="display-8 fw-bold section-title">Our Speciality</h2>
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
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row align-items-center gy-4">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/F1670220299.jpg') }}" class="img-fluid rounded shadow" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <!-- <span class="badge bg-primary mb-3"> -->
                                    <span class="mb-3">Featured</span>
                                    <h4 class="fw-bold">Pelayanan Stroke Terpadu</h4>
                                    <p class="text-muted">
                                        Comprehensive medical services
                                        for Stroke patients.
                                    </p>
                                    <div class="mt-4">
                                        <a href="#" class="btn-learn">Learn More ></a>
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
                                    <img src="{{ asset('images/F1670914854.jpg') }}" class="img-fluid rounded shadow" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <!-- <span class="badge bg-primary mb-3"> -->
                                    <span class="mb-3">Featured</span>
                                    <h4 class="fw-bold">Klinik Nyeri</h4>
                                    <p class="text-muted">
                                        Comprehensive medical services
                                        for Stroke patients. Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis praesentium velit atque dolore, reprehenderit tempore. Illo itaque dolores assumenda quia?
                                    </p>
                                    <div class="mt-4">
                                        <a href="#" class="btn-learn">Learn More ></a>
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
                                    <img src="{{ asset('images/F1670914872.jpg') }}" class="img-fluid rounded shadow" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <!-- <span class="badge bg-primary mb-3"> -->
                                    <span class="mb-3">Featured</span>
                                    <h4 class="fw-bold">Pelayanan Neurofisiologi</h4>
                                    <p class="text-muted">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis deserunt consectetur quos neque eius dicta possimus numquam autem beatae nam.
                                    </p>
                                    <div class="mt-4">
                                        <a href="#" class="btn-learn">Learn More ></a>
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
                                    <img src="{{ asset('images/F1671680565.jpg') }}" class="img-fluid rounded shadow" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <!-- <span class="badge bg-primary mb-3"> -->
                                    <span class="mb-3">Featured</span>
                                    <h4 class="fw-bold">Pelayanan Gawat Darurat</h4>
                                    <p class="text-muted">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste eius illum excepturi pariatur, dicta maiores, voluptas veniam quisquam, cupiditate hic consectetur adipisci ducimus repellendus officiis. Aliquid iure magnam atque iusto?
                                    </p>
                                    <div class="mt-4">
                                        <a href="#" class="btn-learn">Learn More ></a>
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
                                    <img src="{{ asset('images/F1671680579.jpg') }}" class="img-fluid rounded shadow" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <!-- <span class="badge bg-primary mb-3"> -->
                                    <span class="mb-3">Featured</span>
                                    <h4 class="fw-bold">Ruang Rawat Intensif</h4>
                                    <p class="text-muted">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum distinctio iste, aut, magnam inventore dolorem labore ducimus, unde saepe ratione a aliquid error atque magni! Ratione maiores sequi vitae aspernatur aliquam ullam dignissimos accusamus fuga.
                                    </p>
                                    <div class="mt-4">
                                        <a href="#" class="btn-learn">Learn More ></a>
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
                                    <img src="{{ asset('images/F1671680659.jpg') }}" class="img-fluid rounded shadow" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <!-- <span class="badge bg-primary mb-3"> -->
                                    <span class="mb-3">Featured</span>
                                    <h4 class="fw-bold">Klinik Spesialis dan Gigi</h4>
                                    <p class="text-muted">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum eos quaerat debitis odit? Qui, architecto?
                                    </p>
                                    <div class="mt-4">
                                        <a href="#" class="btn-learn">Learn More ></a>
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
    <section id="promotions">
        <div class="title text-center">
            <h2 class="display-8 fw-bold section-title">Paket dan Promo</h2>
        </div>
        <div class="container py-5">
            <div class="row cards">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1749518930.jpg') }}" class="card-img" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>    
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1749518080.jpeg') }}" class="card-img" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>    
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1758074522.jpeg') }}" class="card-img" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>    
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1758075145.jpeg') }}" class="card-img" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1761805772.jpeg') }}" class="card-img" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1761805889.jpeg') }}" class="card-img" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
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
  </body>
</html>