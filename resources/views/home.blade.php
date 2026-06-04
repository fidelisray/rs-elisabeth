<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>RS St. Elisabeth</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid row">
                <a class="navbar-brand col-2" href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="auto" height="80" class="d-inline-block align-text-top">
                </a>
                <form class="d-flex col-6" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="dropdown col-2">
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
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-0">
                            <div class="card-body d-flex text-center align-items-center justify-content-center">
                                <i class="fa-solid fa-user-doctor doctor-icon"></i>
                                <p class="mt-2">Find a Doctor</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-0">
                            <div class="card-body d-flex text-center align-items-center justify-content-center">
                                <i class="fa-regular fa-calendar appointment-icon"></i>
                                <p class="mt-2">Make Appointment</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-0">
                            <div class="card-body d-flex text-center align-items-center justify-content-center">
                                <i class="fa-solid fa-comment-medical medical-icon"></i>
                                <p class="mt-2">Send an Inquiry</p>
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
    <section class="about-us">
        <div class="container-fluid p-2 mb-4 rounded-3">
            <div class="title text-center section-title">
                <h2 class="display-8 fw-bold">Why People Choose Us?</h2>
            </div>
            <div class="container-fluid py-5 row">
                <div class="jumbotron-content px-5 col-md-5">
                    <div class="about-1">
                        <h4>Terakreditasi Paripurna</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, tenetur? Culpa qui consequatur modi, magnam eum distinctio nulla voluptatum iste.</p>
                    </div>
                    <div class="about-2">
                        <h4>Terakreditasi Paripurna</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quis omnis animi ullam, ipsam laboriosam dicta adipisci fugit perferendis voluptatibus ea tempore ipsum quod asperiores?</p>
                    </div>
                    <div class="about-3">
                        <h4>Terakreditasi Paripurna</h4>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maiores sed, assumenda corrupti at earum odit porro, quae amet error officia expedita. Cumque inventore porro illum maiores error eius dicta incidunt, cupiditate molestiae, itaque expedita recusandae?</p>
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
                    <div class="card h-100" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1749518930.jpg') }}" class="card-img-top card-img-fixed" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>    
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1749518080.jpeg') }}" class="card-img-top card-img-fixed" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>    
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1758074522.jpeg') }}" class="card-img-top card-img-fixed" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>    
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1758075145.jpeg') }}" class="card-img-top card-img-fixed" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1761805772.jpeg') }}" class="card-img-top card-img-fixed" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="width: 22rem;">
                        <img src="{{ asset('images/ADS1761805889.jpeg') }}" class="card-img-top card-img-fixed" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/726e331ad1.js" crossorigin="anonymous"></script>
  </body>
</html>