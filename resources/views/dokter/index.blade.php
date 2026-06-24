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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
            <div class="hero-img">
                <i class="fa-solid fa-stethoscope stethoscope-icon"></i>
            </div>
            <div class="hero-header container-fluid">
                <h1 class="display-5 fw-bold text-body-emphasis">Dokter Kami</h1>
            </div>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Tim Dokter Berpengalaman kami akan selalu siap sedia untuk memberikan pelayanan kesehatan terbaik dan professional untuk anda dan keluarga</p>
            </div>
        </div>
    </section>
    <section class="container-fluid toolbar-panel py-3">
        <!-- Toolbar -->

        <div class="toolbar container">
            <div class="row align-items-start justify-content-center">
                <!-- Dropdown Klinik -->
                <div class="col-lg-4">
                    <label class="form-label fw-semibold mb-3">
                        <i class="bi bi-hospital me-2"></i>
                        Klinik
                    </label>
                    <div class="dropdown w-100">
                        <button
                            class="btn dropdown-toggle w-100 text-start d-flex justify-content-between align-items-center"
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
                                {{-- @foreach ($units as $unit)
                                    @if (str_contains(strtolower($unit->Name), 'klinik'))
                                <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="{{ ucwords(strtolower(str_replace(['|OUTPATIENT','|DIAGNOSTIC'],'', $unit->Name))) }}"
                                    data-code="{{ $unit->Code }}">
                                    {{ ucwords(strtolower(str_replace(['|OUTPATIENT','|DIAGNOSTIC'],'', $unit->Name))) }}
                                </button>
                                    @endif
                                @endforeach --}}
                                @foreach ($spesialisasi as $spesialis)
                                    {{-- @if (str_contains(strtolower($spesialis->Name), 'klinik')) --}}
                                <button
                                    type="button"
                                    class="dropdown-item clinic-option"
                                    data-value="{{ $spesialis->Name }}"
                                    data-code="{{ $spesialis->Code }}">
                                    {{ $spesialis->Name }}
                                </button>
                                    {{-- @endif --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Search -->
                <div class="col-lg-6">
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
                <div class="action col-lg-2">
                    <label class="form-label opacity-0 mb-3">
                        Action
                    </label>
                    <div class="action-button d-flex gap-3">
                        <button
                            type="button"
                            id="btnCari"
                            class="btn px-4">
                            Cari
                        </button>
                        <button
                            type="button"
                            id="btnReset"
                            class="btn px-4">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid main-content py-3">
        <section class="container" id="dokter-container">
            
            <!-- ================================================= -->
            <!-- -------------------Card Dokter------------------- -->
            <!-- ================================================= -->
            <div id="daftar-dokter">

            </div>

            <!-- ================================================= -->
            <!-- ---------------Default Card Dokter--------------- -->
            <!-- ================================================= -->
            <div id="default-card">
                
            </div>

            <!-- ================================================= -->
            <!-- ---------------Detail Dokter Modal--------------- -->
            <!-- ================================================= -->
    
            <div class="modal fade" id="detailDokter" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dokter">
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
                                    <div id="foto-dokter" class="doctor-photo">
                                        
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold" id="namaDokter">
                                        </h5>
                                        <span class="speciality-badge d-none">
                                        </span>
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
    
                                        <div class="section-tentang col-lg">
                                            <div class="section-header row">
                                                <div class="col-12">
                                                    <div class="section-title">
                                                        Tentang Dokter
                                                    </div>
                                                    <p class="text-secondary">
                                                        Dokter berpengalaman yang siap memberikan pelayanan
                                                        kesehatan terbaik.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="dokter-info row gx-3 gy-3">
                                                <!-- Location -->
                                                <div class="col-12 col-lg-4">
                                                    <div class="info-box">
                                                        <div class="info-icon">
                                                            <i class="bi bi-geo-alt"></i>
                                                        </div>
                                                        <div>
                                                            <div class="info-label">Lokasi</div>
                                                            <div>Semarang, Indonesia</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Experience -->
                                                <div class="col-12 col-lg-4">
                                                    <div class="info-box">
                                                        <div class="info-icon">
                                                            <i class="bi bi-briefcase"></i>
                                                        </div>
                                                        <div>
                                                            <div class="info-label">Pengalaman</div>
                                                            <strong>Lebih Dari 5 Tahun</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Education -->
                                                <div class="col-12 col-lg-4">
                                                    <div class="info-box">
                                                        <div class="info-icon">
                                                            <i class="bi bi-mortarboard"></i>
                                                        </div>
                                                        <div>
                                                            <div class="info-label">Pendidikan</div>
                                                            <strong>Universitas Terkemuka</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- CTA -->
                                            <div class="info-button row">
                                                <div class="button-group col-lg-12">
                                                    <button type="button" class="cta-btn mt-4 button-janji">
                                                        <i class="fa-brands fa-whatsapp"></i>
                                                        Buat Janji Dokter
                                                        <i class="bi bi-chevron-right float-end"></i>
                                                    </button>
                                                </div>
                                            </div>
    
                                        </div>
    
                                    </div>
    
                                    <!-- SECTION JADWAL -->
                                    <div
                                        class="tab-pane fade"
                                        id="jadwal-pane">
    
                                        <!-- isi jadwal di bawah -->
                                        <div class="section-jadwal col-lg">
                                            
                                            <div class="section-header row">
                                                <div class="col-12">
                                                    <div class="section-title">
                                                        <i class="bi bi-clock me-2"></i>
                                                        Jadwal Praktik
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="schedule-cards">
                                                <div id="schedule-cards" class="row gx-3 gy-3">

                                                </div>
                                            </div>

                                            {{-- <div class="schedule-card d-none">
                                                <div class="day-badge"></div>
    
                                                <div>
                                                    <div class="schedule-day"></div>
                                                    <span class="schedule-time">
                                                    </span>
                                                </div>
                                            </div> --}}
                                            
                                            <div class="info-button row">
                                                <div class="button-group col-lg-12">
                                                    <button type="button" class="cta-btn mt-4 button-janji">
                                                        <i class="fa-brands fa-whatsapp"></i>
                                                        Buat Janji Dokter
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
                </div>
            </div>

        </section>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/726e331ad1.js" crossorigin="anonymous"></script>
    @vite([
        'resources/js/dokter/dokter.js',
        'resources/js/dokter/script.js'
    ])
</body>
</html>