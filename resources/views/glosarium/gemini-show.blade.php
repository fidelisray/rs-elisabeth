<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }} - Symptoms and causes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-title { border-bottom: 2px solid #dee2e6; padding-bottom: 5px; margin-top: 30px; margin-bottom: 15px;}
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <!-- Breadcrumb Navigasi -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('gemini-glossary.gemini') }}" class="text-decoration-none">Diseases & Conditions</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
      </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm border-0 p-4 p-md-5 bg-white">
                
                <h1 class="fw-bold text-dark mb-2">{{ $title }}</h1>
                <a href="{{ $diseaseData['url'] }}" target="_blank" class="text-muted text-decoration-none mb-4 d-inline-block">
                    <Cite>Sumber ></Cite>
                </a>

                <!-- Loop Konten Penyakit -->
                @foreach($diseaseData['sections'] as $section)
                    <div>
                        <h3 class="section-title fw-bold text-secondary">{{ $section['judul'] }}</h3>
                        
                        @foreach($section['paragraf'] as $paragraf)
                            <p style="font-size: 1.05rem; line-height: 1.7;">{{ $paragraf }}</p>
                        @endforeach

                        @if(!empty($section['list_groups']))
                            @foreach($section['list_groups'] as $listGroup)
                                <div class="my-3 ps-3 border-start border-4 border-primary bg-light p-3">
                                    <h6 class="fw-bold">{{ $listGroup['judul_list'] }}</h6>
                                    <ul class="mb-0">
                                        @foreach($listGroup['items'] as $listItem)
                                            <li class="mb-2" style="font-size: 1.05rem;">{{ $listItem }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>

</body>
</html>