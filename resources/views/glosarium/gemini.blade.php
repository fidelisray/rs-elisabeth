<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Glossary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .glossary-sidebar {
            position: sticky;
            top: 20px;
        }
        .nav-pills .nav-link {
            color: #495057;
            border-left: 3px solid transparent;
            margin-bottom: 5px;
            text-align: left;
        }
        .nav-pills .nav-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
            border-left: 3px solid #0d6efd;
            font-weight: bold;
        }
        .section-title {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 5px;
            margin-top: 25px;
            color: #212529;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h1 class="fw-bold text-primary">Kamus Kesehatan & Istilah Medis</h1>
            <p class="text-muted">Pusat informasi lengkap mengenai berbagai kondisi dan penyakit.</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card shadow-sm glossary-sidebar">
                <div class="card-header bg-dark text-white fw-semibold">
                    Daftar Istilah {{ count($glossaryData) }}
                </div>
                <div class="card-body p-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($glossaryData as $index => $item)
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                    id="v-pills-{{ $item['slug'] }}-tab" 
                                    data-bs-toggle="pill" 
                                    data-bs-target="#v-pills-{{ $item['slug'] }}" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="v-pills-{{ $item['slug'] }}" 
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $item['title'] }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-lg-9">
            <div class="tab-content" id="v-pills-tabContent">
                @foreach($glossaryData as $index => $item)
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                         id="v-pills-{{ $item['slug'] }}" 
                         role="tabpanel" 
                         aria-labelledby="v-pills-{{ $item['slug'] }}-tab" 
                         tabindex="0">
                        
                        <div class="card shadow-sm border-0 p-4 mb-4 bg-white">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                                <h2 class="fw-bold m-0 text-dark">{{ $item['title'] }}</h2>
                                <a href="{{ $item['url'] }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    Lihat Sumber Asli &rarr;
                                </a>
                            </div>

                            @foreach($item['sections'] as $section)
                                <div class="mb-4">
                                    <h4 class="section-title fw-semibold text-secondary">{{ $section['judul'] }}</h4>
                                    
                                    @foreach($section['paragraf'] as $paragraf)
                                        <p class="text-body-secondary" style="line-height: 1.6;">{{ $paragraf }}</p>
                                    @endforeach

                                    @if(!empty($section['list_groups']))
                                        @foreach($section['list_groups'] as $listGroup)
                                            <div class="card bg-light border-0 my-3">
                                                <div class="card-body">
                                                    <h6 class="fw-bold text-dark">{{ $listGroup['judul_list'] }}</h6>
                                                    <ul class="list-group list-group-flush bg-transparent mt-2">
                                                        @foreach($listGroup['items'] as $listItem)
                                                            <li class="list-group-item bg-transparent border-0 ps-0 py-1">
                                                                <i class="text-primary me-2">&bull;</i> {{ $listItem }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>