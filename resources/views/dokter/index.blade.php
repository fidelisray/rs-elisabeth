<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokter Kami</title>
    @vite([
        'resources/css/style.css',
        'resources/css/dokter.css',
        'resources/js/dokter/script.js'
    ])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('css/dokter.css') }}"> -->
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
    </header>
    <section id="hero" class="container-fluid d-flex align-items-center justify-content-center">
        <div class="text-center">
            <!-- <img class="d-block mx-auto mb-4" src="https://getbootstrap.com" alt="Logo" width="72" height="57"> -->
            <div class="hero-img">
                <i class="fa-solid fa-stethoscope stethoscope-icon"></i>
            </div>
            <div class="hero-header container-fluid">
                <h1 class="display-5 fw-bold text-body-emphasis">Dokter Kami</h1>
            </div>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Tim Dokter Berpengalaman kami akan selalu siap sedia untuk memberikan pelayanan kesehatan terbaik dan professional untuk anda dan keluarga</p>
                <!-- <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
                </div> -->
            </div>
        </div>
    </section>
    <!-- <section class="navigation-panel">
        <div class="container">
            <div class="filter-group">
                <div class="filter-group-label">Kategori A</div>
                <div class="filter-chips" data-group="kategoriA">
                    <button class="chip" data-value="opsi-1">Opsi 1</button>
                </div>
            </div>
        </div>
    </section> -->
    <section class="container navigation-panel py-3">
        <!-- Toolbar -->
        <div class="toolbar-container">
            <div class="d-flex justify-content-center align-items-center gap-2">

                <!-- Desktop Search -->
                <div class="flex-grow-1 d-none d-md-block">
                    <input
                        type="text"
                        class="form-control search-input"
                        placeholder="Cari dokter, spesialisasi...">
                </div>
                <!-- Mobile Search Button -->
                <button
                    class="btn btn-outline-secondary toolbar-btn d-md-none"
                    data-bs-toggle="modal"
                    data-bs-target="#searchModal">
                    <!-- <i class="bi bi-search"></i> -->
                    <i class="fa-brands fa-sistrix"></i>
                </button>

                <!-- Filter Button -->
                <button
                    class="btn btn-outline-primary toolbar-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#filterModal">
                    <!-- <i class="bi bi-funnel"></i> -->
                    <i class="fa-solid fa-filter"></i>
                    Cari Poli
                </button>

                <!-- Sort Dropdown -->
                <div class="dropdown">
                    <button
                        class="btn btn-outline-secondary dropdown-toggle sort-dropdown"
                        type="button"
                        data-bs-toggle="dropdown">
                        <i class="fa-solid fa-sliders"></i>
                        Urutkan
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">A - Z</a></li>
                        <li><a class="dropdown-item" href="#">Z - A</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="row align-items-start g-4">
                <!-- Dropdown Klinik -->
                <div class="col-lg-4">
                    <label class="form-label fw-semibold mb-3">
                        <i class="bi bi-hospital me-2"></i>
                        Klinik
                    </label>
                    <div class="dropdown w-100">
                        <button
                            class="btn btn-outline-secondary dropdown-toggle w-100 text-start d-flex justify-content-between align-items-center"
                            type="button"
                            id="clinicDropdown"
                            data-bs-toggle="dropdown"
                            data-selected="">
                            Pilih Klinik
                        </button>
                        <div class="dropdown-menu p-0 w-100">
                            <!-- Search Klinik -->
                            <div class="p-2 border-bottom">
                                <input
                                    type="text"
                                    id="clinicSearch"
                                    class="form-control"
                                    placeholder="Cari Klinik...">
                            </div>
                            <!-- List Klinik -->
                            <div
                                id="clinicList"
                                class="clinic-list">
                                @foreach ($units as $unit)
                                    @if (str_contains(strtolower($unit->Name), 'klinik'))
                                <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="{{ ucwords(strtolower(str_replace(['|OUTPATIENT','|DIAGNOSTIC'],'', $unit->Name))) }}"
                                    data-code="{{ $unit->Code }}">
                                    {{ ucwords(strtolower(str_replace(['|OUTPATIENT','|DIAGNOSTIC'],'', $unit->Name))) }}
                                </button>
                                    @endif
                                @endforeach
                                <!-- <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="Klinik Gigi">
                                    Klinik Gigi
                                </button>
                                <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="Klinik Anak">
                                    Klinik Anak
                                </button>
                                <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="Klinik Penyakit Dalam">
                                    Klinik Penyakit Dalam
                                </button>
                                <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="Klinik Saraf">
                                    Klinik Saraf
                                </button>
                                <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="Klinik Jantung">
                                    Klinik Jantung
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Search -->
                <div class="col-lg-4">
                    <label class="form-label fw-semibold mb-3">
                        <i class="bi bi-search me-2"></i>
                        Cari
                    </label>
                    <input
                        type="text"
                        id="searchKeyword"
                        class="form-control"
                        placeholder="Cari dokter, spesialis, atau klinik">

                </div>
                <!-- Button -->
                <div class="col-lg-4">
                    <label class="form-label opacity-0">
                        Action
                    </label>
                    <div class="d-flex gap-3">
                        <button
                            type="button"
                            id="btnCari"
                            class="btn btn-info text-white px-4">
                            Cari
                        </button>
                        <button
                            type="button"
                            id="btnReset"
                            class="btn btn-outline-info px-4">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================= -->
    <!-- FILTER MODAL -->
    <!-- ================================================= -->

    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Berdasarkan Poli</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Definisikan kategori sendiri -->
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#flush-collapseOne" 
                                        aria-expanded="false" 
                                        aria-controls="flush-collapseOne">
                                    Poli Executive
                                </button>
                            </h2>
                            <div id="flush-collapseOne" 
                                 class="accordion-collapse collapse" 
                                 aria-labelledby="flush-headingOne" 
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <!-- START <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="cat1">
                                        <label class="form-check-label" for="cat1">
                                            Poli Umum
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="cat2">
                                        <label class="form-check-label" for="cat2">
                                            Poli Eksekutif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cat3">
                                        <label class="form-check-label" for="cat3">
                                            Kategori 3
                                        </label>
                                    </div> END --> 
                                    <div class="d-grid gap-2" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio1" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio1">Poli Executive 1</label>

                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio2" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio2">Poli Executive 2</label>

                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio3" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio3">Poli Executive 3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#flush-collapseTwo" 
                                        aria-expanded="false" 
                                        aria-controls="flush-collapseTwo">
                                    Poli Specialist
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" 
                                 class="accordion-collapse collapse" 
                                 aria-labelledby="flush-headingTwo" 
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="d-grid gap-2" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio4" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio4">Poli Specialist 1</label>

                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio5" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio5">Poli Specialist 2</label>

                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio6" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio6">Poli Specialist 3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#flush-collapseThree" 
                                        aria-expanded="false" 
                                        aria-controls="flush-collapseThree">
                                    Poli Regular
                                </button>
                            </h2>
                            <div id="flush-collapseThree" 
                                 class="accordion-collapse collapse" 
                                 aria-labelledby="flush-headingThree" 
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="d-grid gap-2" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio7" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio7">Poli Regular 1</label>

                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio8" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio8">Poli Regular 2</label>

                                        <input type="radio" class="btn-check poli-radio" name="btnradio" id="btnradio9" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btnradio9">Poli Regular 3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-primary">
                        Terapkan Filter
                    </button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- ================================================= -->
    <!-- MOBILE SEARCH MODAL -->
    <!-- ================================================= -->

    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pencarian</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Cari data...">
                        <button class="btn btn-primary">
                            <!-- <i class="bi bi-search"></i> -->
                            <i class="fa-brands fa-sistrix"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid main-content py-3">
        <section class="container d-none">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://placehold.co/120"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">Dr. Budi Santoso, Sp.KJ</h5>
                                <span class="badge bg-primary mb-3">
                                    Spesialis Jantung
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>
                            <!-- <select class="form-select">
                                <option selected>
                                    Pilih Jadwal
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 09:00
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 13:00
                                </option>
                                <option>
                                    Selasa, 10 Juni 2026 - 08:00
                                </option>
                            </select> -->
                            <div class="col align-items-center">
    
                                <div class="row">
    
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="schedule">
                                            <h5 class="schedule-title">Senin</h5>
                                            <small>14:00 - 16:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Selasa</h5>
                                            <small>08:00 - 10:00</small>
                                            <small>12:00 - 14:00</small>
                                            <small>15:00 - 16:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Rabu</h5>
                                            <small>09:00 - 11:00</small>
                                        </div>
                                        <div class="schedule off-day">
                                            <h5 class="schedule-title">Kamis</h5>
                                            <small>-</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Jumat</h5>
                                            <small>12:00 - 14:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Sabtu</h5>
                                            <small>08:00 - 10:00</small>
                                            <small>11:00 - 12:00</small>
                                            <small>15:00 - 16:00</small>
                                            <small>18:00 - 19:00</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-muted">
                                            Jadwal dipilih:
                                        </span>
                                        <div
                                            id="selectedSchedule"
                                            class="selected-schedule">
                                            Belum memilih jadwal
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- Tombol -->
                        <!-- <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    class="btn btn-primary">
                                    Buat Janji
                                </button>
                            </div>
                        </div> -->
                        <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <!-- <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    id="bookBtn"
                                    class="btn btn-primary">
                                    Buat Janji
                                </button> -->
                                <a 
                                    href="#" 
                                    class="btn btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailDokter">Cek Profil</a>
                                <a href="https://regonline.rs-elisabeth.com/" class="btn btn-success" target="_blank">Buat Janji</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    
            
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://placehold.co/120"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">Dr. Budi Santoso, Sp.KJ</h5>
                                <span class="badge bg-primary mb-3">
                                    Spesialis Jantung
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>
                            <!-- <select class="form-select">
                                <option selected>
                                    Pilih Jadwal
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 09:00
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 13:00
                                </option>
                                <option>
                                    Selasa, 10 Juni 2026 - 08:00
                                </option>
                            </select> -->
                            <div class="col align-items-center">
    
                                <div class="row">
    
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="schedule">
                                            <h5 class="schedule-title">Senin</h5>
                                            <small>14:00 - 16:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Selasa</h5>
                                            <small>08:00 - 10:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Rabu</h5>
                                            <small>09:00 - 11:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Kamis</h5>
                                            <small>12:00 - 14:00</small>
                                            <small>12:00 - 14:00</small>
                                            <small>12:00 - 14:00</small>
                                        </div>
                                        <div class="schedule off-day">
                                            <h5 class="schedule-title">Jumat</h5>
                                            <small>-</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Sabtu</h5>
                                            <small>08:00 - 10:00</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-muted">
                                            Jadwal dipilih:
                                        </span>
                                        <div
                                            id="selectedSchedule"
                                            class="selected-schedule">
                                            Belum memilih jadwal
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- Tombol -->
                        <!-- <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    class="btn btn-primary">
                                    Buat Janji
                                </button>
                            </div>
                        </div> -->
                        <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <!-- <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    id="bookBtn"
                                    class="btn btn-primary">
                                    Buat Janji
                                </button> -->
                                <a 
                                    href="#" 
                                    class="btn btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailDokter">Cek Profil</a>
                                <a href="https://regonline.rs-elisabeth.com/" class="btn btn-success" target="_blank">Buat Janji</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    
    
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://placehold.co/120"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">Dr. Budi Santoso, Sp.KJ</h5>
                                <span class="badge bg-primary mb-3">
                                    Spesialis Jantung
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>
                            <!-- <select class="form-select">
                                <option selected>
                                    Pilih Jadwal
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 09:00
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 13:00
                                </option>
                                <option>
                                    Selasa, 10 Juni 2026 - 08:00
                                </option>
                            </select> -->
                            <div class="col align-items-center">
    
                                <div class="row">
    
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="schedule">
                                            <h5 class="schedule-title">Senin</h5>
                                            <small>14:00 - 16:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Selasa</h5>
                                            <small>08:00 - 10:00</small>
                                            <small>08:00 - 10:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Rabu</h5>
                                            <small>09:00 - 11:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Kamis</h5>
                                            <small>08:00 - 10:00</small>
                                        </div>
                                        <div class="schedule">
                                            <h5 class="schedule-title">Jumat</h5>
                                            <small>12:00 - 14:00</small>
                                        </div>
                                        <div class="schedule off-day">
                                            <h5 class="schedule-title">Sabtu</h5>
                                            <small>-</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-muted">
                                            Jadwal dipilih:
                                        </span>
                                        <div
                                            id="selectedSchedule"
                                            class="selected-schedule">
                                            Belum memilih jadwal
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- Tombol -->
                        <!-- <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    class="btn btn-primary">
                                    Buat Janji
                                </button>
                            </div>
                        </div> -->
                        <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <!-- <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    id="bookBtn"
                                    class="btn btn-primary">
                                    Buat Janji
                                </button> -->
                                <a 
                                    href="#" 
                                    class="btn btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailDokter">Cek Profil</a>
                                <a href="https://regonline.rs-elisabeth.com/" class="btn btn-success" target="_blank">Buat Janji</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- ================================================= -->
            <!-- Detail Dokter Modal -->
            <!-- ================================================= -->
    
            <div class="modal fade" id="detailDokter-2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 bg-transparent">
                        <!-- <div class="modal-header">
                            <h5 class="modal-title">Dr. Budi Santoso, Sp.KJ.</h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            Definisikan kategori sendiri
                            
                            
                        </div>
                        <div class="modal-footer">
                            
                        </div> -->
                        <div class="doctor-card">
                            <!-- HEADER -->
                            <div class="profile-header">
                                <button 
                                    type="button"
                                    class="btn-close mb-2 float-end"
                                    data-bs-dismiss="modal">
                                </button>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="doctor-photo">
                                        <img src="https://via.placeholder.com/120x120" alt="Doctor">
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">
                                            Dr. Nama Dokter, M.Psi, Psikolog
                                        </h5>
                                        <span class="speciality-badge">
                                            Psikolog
                                        </span>
                                    </div>
                                </div>
                                <div class="stats">
                                    <div class="stat-pill">
                                        ⭐ 5
                                    </div>
    
                                    <div class="stat-pill">
                                        <i class="bi bi-people"></i> 3,792
                                    </div>
                                </div>
                            </div>
                            <!-- TABS -->
                            <ul class="nav nav-tabs justify-content-center mt-2">
                                <!-- <li class="nav-item">
                                    <button
                                        type="button" 
                                        class="nav-link active">
                                        Tentang
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button 
                                        type="button"
                                        class="nav-link">
                                        Jadwal
                                    </button>
                                </li> -->
                                <ul class="nav nav-tabs justify-content-center mt-2" id="doctorTabs" role="tablist">
                                    <li class="nav-item flex-fill text-center">
                                        <button
                                            class="nav-link active w-100"
                                            id="tentang-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#tentang-pane-2"
                                            type="button">
                                            Tentang
                                        </button>
                                    </li>
    
                                    <li class="nav-item flex-fill text-center">
                                        <button
                                            class="nav-link w-100"
                                            id="jadwal-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#jadwal-pane-2"
                                            type="button">
                                            Jadwal
                                        </button>
                                    </li>
                                </ul>
                            </ul>
                            <!-- CONTENT -->
                            <!-- <div class="content-section">
                                <div class="section-tentang">
                                    
                                </div>
                            </div> -->
                            <div class="content-section">
                                <div class="tab-content">
    
                                    <div
                                        class="tab-pane fade show active"
                                        id="tentang-pane-2">
    
                                        <div class="section-tentang">
                                            <div class="section-title">
                                                <i class="bi bi-stethoscope me-2"></i>
                                                Tentang Dokter
                                            </div>
                                            <p class="text-secondary">
                                                Dokter berpengalaman yang siap memberikan pelayanan
                                                kesehatan terbaik.
                                            </p>
                                            <!-- Location -->
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                                <div>
                                                    <div class="info-label">Lokasi</div>
                                                    <div>Semarang, Indonesia</div>
                                                </div>
                                            </div>
                                            <!-- Experience -->
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="bi bi-briefcase"></i>
                                                </div>
                                                <div>
                                                    <div class="info-label">Pengalaman</div>
                                                    <strong>Lebih Dari 5 Tahun</strong>
                                                </div>
                                            </div>
                                            <!-- Education -->
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="bi bi-mortarboard"></i>
                                                </div>
                                                <div>
                                                    <div class="info-label">Pendidikan</div>
                                                    <strong>Universitas Terkemuka</strong>
                                                </div>
                                            </div>
                                            <!-- CTA -->
                                            <button type="button" class="cta-btn mt-4">
                                                <i class="fa-brands fa-whatsapp"></i>
                                                Informasi Lebih Lanjut
                                                <i class="bi bi-chevron-right float-end"></i>
                                            </button>
    
                                        </div>
    
                                    </div>
    
                                    <!-- SECTION JADWAL -->
                                    <div
                                        class="tab-pane fade"
                                        id="jadwal-pane-2">
    
                                        <!-- isi jadwal di bawah -->
                                        <div class="section-jadwal">
    
                                            <div class="section-title">
                                                <i class="bi bi-clock me-2"></i>
                                                Jadwal Praktik
                                            </div>
    
                                            <div class="schedule-card">
                                                <div class="day-badge">SEN</div>
    
                                                <div>
                                                    <div class="schedule-day">Senin</div>
                                                    <span class="schedule-time">
                                                        14:00 - 16:00
                                                    </span>
                                                </div>
                                            </div>
    
                                            <div class="schedule-card">
                                                <div class="day-badge">SEL</div>
    
                                                <div>
                                                    <div class="schedule-day">Selasa</div>
                                                    <span class="schedule-time">
                                                        08:00 - 10:00
                                                    </span>
                                                    <span class="schedule-time">
                                                        12:00 - 14:00
                                                    </span>
                                                    <span class="schedule-time">
                                                        15:00 - 16:00
                                                    </span>
                                                </div>
                                            </div>
    
                                            <div class="schedule-card">
                                                <div class="day-badge">RAB</div>
    
                                                <div>
                                                    <div class="schedule-day">Rabu</div>
                                                    <span class="schedule-time">
                                                        09:00 - 11:00
                                                    </span>
                                                </div>
                                            </div>
    
                                            <div class="schedule-card day-off">
                                                <div class="day-badge">KAM</div>
    
                                                <div>
                                                    <div class="schedule-day">Kamis</div>
                                                    <span class="schedule-time">
                                                        -
                                                    </span>
                                                </div>
                                            </div>
    
                                            <div class="schedule-card">
                                                <div class="day-badge">JUM</div>
    
                                                <div>
                                                    <div class="schedule-day">Jumat</div>
                                                    <span class="schedule-time">
                                                        12:00 - 14:00
                                                    </span>
                                                </div>
                                            </div>
    
                                            <div class="schedule-card">
                                                <div class="day-badge">SAB</div>
    
                                                <div>
                                                    <div class="schedule-day">Sabtu</div>
                                                    <span class="schedule-time">
                                                        08:00 - 10:00
                                                    </span>
                                                    <span class="schedule-time">
                                                        11:00 - 12:00
                                                    </span>
                                                    <span class="schedule-time">
                                                        15:00 - 16:00
                                                    </span>
                                                    <span class="schedule-time">
                                                        18:00 - 19:00
                                                    </span>
                                                </div>
                                            </div>
    
                                            <button type="button" class="cta-btn mt-4">
                                                <i class="fa-brands fa-whatsapp"></i>
                                                Informasi Lebih Lanjut
                                                <i class="bi bi-chevron-right float-end"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    
    
    
            <div class="card shadow-sm border-0 mb-3" style="display: none;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://via.placeholder.com/120"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">Dr. Budi Santoso, Sp.KJ</h5>
                                <span class="badge bg-success mb-3">
                                    Psikolog
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>
                            <!-- <select class="form-select">
                                <option selected>
                                    Pilih Jadwal
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 09:00
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 13:00
                                </option>
                                <option>
                                    Selasa, 10 Juni 2026 - 08:00
                                </option>
                            </select> -->
                            <div class="col align-items-center">
    
                                <div class="row">
    
                                    <div class="d-flex flex-wrap gap-3">
                                        <button
                                            class="schedule-btn"
                                            data-day="Senin"
                                            data-time="14:00 - 16:00">
            
                                            <div class="fw-bold">Sen</div>
                                            <small>14:00 - 16:00</small>
            
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Selasa"
                                            data-time="08:00 - 10:00">
            
                                            <div class="fw-bold">Sel</div>
                                            <small>08:00 - 10:00</small>
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Rabu"
                                            data-time="14:00 - 16:00">
            
                                            <div class="fw-bold">Rab</div>
                                            <small>14:00 - 16:00</small>
            
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Kamis"
                                            data-time="08:30 - 10:00">
                                            <div class="fw-bold">Kam</div>
                                            <small>08:30 - 10:00</small>
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            disabled>
                                            <div class="fw-bold">Jum</div>
                                            <small>-</small>
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Sabtu"
                                            data-time="09:00 - 12:00">
                                            <div class="fw-bold">Sab</div>
                                            <small>09:00 - 12:00</small>
                                        </button>
                                    </div>
                                </div>
                                <!-- <ul class="d-flex justify-content-center">
                                    <li><a href="#" class="button btn-primary">00:00</a></li>
                                    <li><a href="#" class="button btn-primary">00:00</a></li>
                                    <li><a href="#" class="button btn-primary">00:00</a></li>
                                </ul> -->
                                <div class="row mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-muted">
                                            Jadwal dipilih:
                                        </span>
                                        <div
                                            id="selectedSchedule"
                                            class="selected-schedule">
                                            Belum memilih jadwal
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tombol -->
                        <!-- <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    class="btn btn-primary">
                                    Buat Janji
                                </button>
                            </div>
                        </div> -->
                        <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    id="bookBtn"
                                    class="btn btn-primary">
                                    Buat Janji
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mb-3" style="display: none;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://via.placeholder.com/120"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">Dr. Budi Santoso, Sp.KJ</h5>
                                <span class="badge bg-success mb-3">
                                    Psikolog
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>
                            <!-- <select class="form-select">
                                <option selected>
                                    Pilih Jadwal
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 09:00
                                </option>
                                <option>
                                    Senin, 09 Juni 2026 - 13:00
                                </option>
                                <option>
                                    Selasa, 10 Juni 2026 - 08:00
                                </option>
                            </select> -->
                            <div class="col align-items-center">
    
                                <div class="row">
    
                                    <div class="d-flex flex-wrap gap-3">
                                        <button
                                            class="schedule-btn"
                                            data-day="Senin"
                                            data-time="14:00 - 16:00">
            
                                            <div class="fw-bold">Sen</div>
                                            <small>14:00 - 16:00</small>
            
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Selasa"
                                            data-time="08:00 - 10:00">
            
                                            <div class="fw-bold">Sel</div>
                                            <small>08:00 - 10:00</small>
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Rabu"
                                            data-time="14:00 - 16:00">
            
                                            <div class="fw-bold">Rab</div>
                                            <small>14:00 - 16:00</small>
            
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Kamis"
                                            data-time="08:30 - 10:00">
                                            <div class="fw-bold">Kam</div>
                                            <small>08:30 - 10:00</small>
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            disabled>
                                            <div class="fw-bold">Jum</div>
                                            <small>-</small>
                                        </button>
                                        <button
                                            class="schedule-btn"
                                            data-day="Sabtu"
                                            data-time="09:00 - 12:00">
                                            <div class="fw-bold">Sab</div>
                                            <small>09:00 - 12:00</small>
                                        </button>
                                    </div>
                                </div>
                                <!-- <ul class="d-flex justify-content-center">
                                    <li><a href="#" class="button btn-primary">00:00</a></li>
                                    <li><a href="#" class="button btn-primary">00:00</a></li>
                                    <li><a href="#" class="button btn-primary">00:00</a></li>
                                </ul> -->
                                <div class="row mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-muted">
                                            Jadwal dipilih:
                                        </span>
                                        <div
                                            id="selectedSchedule"
                                            class="selected-schedule">
                                            Belum memilih jadwal
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tombol -->
                        <!-- <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    class="btn btn-primary">
                                    Buat Janji
                                </button>
                            </div>
                        </div> -->
                        <div class="col-md-3">
    
                            <div class="d-grid gap-2">
    
                                <button
                                    class="btn btn-outline-primary">
                                    Detail
                                </button>
                                <button
                                    id="bookBtn"
                                    class="btn btn-primary">
                                    Buat Janji
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card doctor-card shadow-sm" style="display: none;">
                <div class="row g-0">
                    <!-- LEFT PROFILE -->
                    <div class="col-lg-3 border-end">
                        <div class="profile-section d-flex flex-column justify-content-center align-items-center p-4">
                            <img
                                src="https://via.placeholder.com/120"
                                class="doctor-photo mb-3"
                                alt="Doctor">
                            <h5 class="fw-bold mb-2 text-center">
                                dr. Aisyah Rahma, Sp.JP
                            </h5>
                            <p class="text-muted mb-2">
                                Spesialis Jantung
                            </p>
                            <span class="badge bg-success px-3 py-2">
                                Jantung dan Pembuluh Darah
                            </span>
                            <a href="#" class="mt-3 text-decoration-none">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    <!-- RIGHT CONTENT -->
                    <div class="col-lg-9">
                        <div class="p-4">
                            <!-- Schedule Buttons -->
        
                            <div class="d-flex flex-wrap gap-3">
                                <button
                                    class="schedule-btn"
                                    data-day="Senin"
                                    data-time="14:00 - 16:00">
    
                                    <div class="fw-bold">Sen</div>
                                    <small>14:00 - 16:00</small>
    
                                </button>
                                <button
                                    class="schedule-btn"
                                    data-day="Selasa"
                                    data-time="08:00 - 10:00">
    
                                    <div class="fw-bold">Sel</div>
                                    <small>08:00 - 10:00</small>
                                </button>
                                <button
                                    class="schedule-btn"
                                    data-day="Rabu"
                                    data-time="14:00 - 16:00">
    
                                    <div class="fw-bold">Rab</div>
                                    <small>14:00 - 16:00</small>
    
                                </button>
                                <button
                                    class="schedule-btn"
                                    data-day="Kamis"
                                    data-time="08:30 - 10:00">
                                    <div class="fw-bold">Kam</div>
                                    <small>08:30 - 10:00</small>
                                </button>
                                <button
                                    class="schedule-btn"
                                    disabled>
                                    <div class="fw-bold">Jum</div>
                                    <small>-</small>
                                </button>
                                <button
                                    class="schedule-btn"
                                    data-day="Sabtu"
                                    data-time="09:00 - 12:00">
                                    <div class="fw-bold">Sab</div>
                                    <small>09:00 - 12:00</small>
                                </button>
                            </div>
                            <hr class="my-4">
                            <!-- Selected Schedule -->
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="text-muted">
                                            Jadwal dipilih:
                                        </span>
                                        <div
                                            id="selectedSchedule"
                                            class="selected-schedule">
                                            Belum memilih jadwal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3 mt-md-0">
                                    <div class="d-flex justify-content-md-end gap-2">
                                        <button
                                            class="btn btn-outline-secondary">
                                            Detail
                                        </button>
                                        <button
                                            id="bookBtn"
                                            class="btn btn-primary"
                                            disabled>
                                            Buat Janji
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container" id="daftar-dokter">
            
            <!-- CARD DOKTER -->
            @foreach ($doctors as $doctor)
            <div class="card shadow-sm border-0 mb-3">

                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://placehold.co/120"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">{{ $doctor['ParamedicName']}}</h5>
                                <span class="badge bg-primary mb-3 d-none">
                                    Spesialis Jantung
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>
                            <div class="col align-items-center">
    
                                <div class="row">
    
                                    <div class="d-flex flex-wrap gap-3">
                                        @php
                                            $listJadwal = [];
                                        @endphp
                                        @foreach ($doctor['Schedules'] as $jadwal)
                                            @php
                                                $jadwalHariIni = collect(explode('|', $jadwal['OperationalTimeName']))
                                                        ->map(fn ($item) => trim($item))
                                                        ->toArray();
                                                $listJadwal[] = [
                                                    'hari' => $jadwal['Day'],
                                                    'jam' => $jadwalHariIni
                                                ];
                                            @endphp
                                            <div class="schedule">
                                                <h5 class="schedule-title">{{ $jadwal['Day']}}</h5>
                                                @foreach ($jadwalHariIni as $jam)
                                                    <small>{{ $jam }}</small>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tombol -->
                        <div class="col-md-3">
                            <div class="d-grid gap-2">
                                <a 
                                    href='#' 
                                    class='btn btn-outline-primary'
                                    data-bs-toggle='modal'
                                    data-bs-target='#detailDokter'

                                    data-nama='{{ $doctor["ParamedicName"] }}'
                                    data-jadwal='@json($listJadwal)'>Cek Profil</a>
                                <a href="https://regonline.rs-elisabeth.com/" class="btn btn-success" target="_blank">Buat Janji</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


            <!-- ================================================= -->
            <!-- ---------------Detail Dokter Modal--------------- -->
            <!-- ================================================= -->
    
            <div class="modal fade" id="detailDokter" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 bg-transparent">
                        <div class="doctor-card">
                            <!-- HEADER -->
                            <div class="profile-header">
                                <button 
                                    type="button"
                                    class="btn-close mb-2 float-end"
                                    data-bs-dismiss="modal">
                                </button>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="doctor-photo">
                                        <img src="https://via.placeholder.com/120x120" alt="Doctor">
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold" id="namaDokter">
                                        </h5>
                                        <span class="speciality-badge d-none">
                                        </span>
                                    </div>
                                </div>
                                <div class="stats">
                                    <div class="stat-pill">
                                        ⭐ 5
                                    </div>
    
                                    <div class="stat-pill">
                                        <i class="bi bi-people"></i> 3,792
                                    </div>
                                </div>
                            </div>
                            <!-- TABS -->
                            <ul class="nav nav-tabs justify-content-center mt-2">
                                <ul class="nav nav-tabs justify-content-center mt-2" id="doctorTabs" role="tablist">
                                    <li class="nav-item flex-fill text-center">
                                        <button
                                            class="nav-link active w-100"
                                            id="tentang-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#tentang-pane"
                                            type="button">
                                            Tentang
                                        </button>
                                    </li>
    
                                    <li class="nav-item flex-fill text-center">
                                        <button
                                            class="nav-link w-100"
                                            id="jadwal-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#jadwal-pane"
                                            type="button">
                                            Jadwal
                                        </button>
                                    </li>
                                </ul>
                            </ul>
                            <!-- CONTENT -->
                            <div class="content-section">
                                <div class="tab-content">
    
                                    <div
                                        class="tab-pane fade show active"
                                        id="tentang-pane">
    
                                        <div class="section-tentang">
                                            <div class="section-title">
                                                <i class="bi bi-stethoscope me-2"></i>
                                                Tentang Dokter
                                            </div>
                                            <p class="text-secondary">
                                                Dokter berpengalaman yang siap memberikan pelayanan
                                                kesehatan terbaik.
                                            </p>
                                            <!-- Location -->
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                                <div>
                                                    <div class="info-label">Lokasi</div>
                                                    <div>Semarang, Indonesia</div>
                                                </div>
                                            </div>
                                            <!-- Experience -->
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="bi bi-briefcase"></i>
                                                </div>
                                                <div>
                                                    <div class="info-label">Pengalaman</div>
                                                    <strong>Lebih Dari 5 Tahun</strong>
                                                </div>
                                            </div>
                                            <!-- Education -->
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="bi bi-mortarboard"></i>
                                                </div>
                                                <div>
                                                    <div class="info-label">Pendidikan</div>
                                                    <strong>Universitas Terkemuka</strong>
                                                </div>
                                            </div>
                                            <!-- CTA -->
                                            <button type="button" class="cta-btn mt-4">
                                                <i class="fa-brands fa-whatsapp"></i>
                                                Informasi Lebih Lanjut
                                                <i class="bi bi-chevron-right float-end"></i>
                                            </button>
    
                                        </div>
    
                                    </div>
    
                                    <!-- SECTION JADWAL -->
                                    <div
                                        class="tab-pane fade"
                                        id="jadwal-pane">
    
                                        <!-- isi jadwal di bawah -->
                                        <div class="section-jadwal">
    
                                            <div class="section-title">
                                                <i class="bi bi-clock me-2"></i>
                                                Jadwal Praktik
                                            </div>

                                            <div id="schedule-cards" class="schedule-cards">

                                            </div>

                                            <div class="schedule-card d-none">
                                                <div class="day-badge"></div>
    
                                                <div>
                                                    <div class="schedule-day"></div>
                                                    <span class="schedule-time">
                                                    </span>
                                                </div>
                                            </div>
    
                                            <button type="button" class="cta-btn mt-4">
                                                <i class="fa-brands fa-whatsapp"></i>
                                                Informasi Lebih Lanjut
                                                <i class="bi bi-chevron-right float-end"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/726e331ad1.js" crossorigin="anonymous"></script>
    @vite(['resources/js/dokter/dokter.js'])
</body>
</html>