<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Promotions</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        @vite([
            'resources/js/app.js',
            'resources/js/bootstrap.js',
            'resources/css/app.css',
            'resources/css/style.css',
        ]);
    </head>
    <body>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>