@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'RS Sehat - Rumah sakit pilihan keluarga Indonesia')

@section('content')

{{-- Hero Section --}}
<section class="hero">
    <h1>Kesehatan Anda, Prioritas Kami</h1>
    <!-- <a href="{{ route('cara-daftar') }}" class="btn-primary">Daftar Sekarang</a> -->
</section>

{{-- Dokter Unggulan --}}
<section class="dokter-unggulan">
    <h2>Dokter Unggulan</h2>

    @if(empty($dokterUnggulan))
        <p class="text-muted">Data dokter sedang tidak tersedia.</p>
    @else
        <div class="grid">
            @foreach($dokterUnggulan as $dokter)
                <x-card-dokter :dokter="$dokter" />
            @endforeach
        </div>
    @endif

    <a href="{{ route('dokter.index') }}">Lihat Semua Dokter →</a>
</section>

{{-- Layanan / Poliklinik --}}
<section class="layanan">
    <h2>Layanan Kami</h2>
    <div class="grid">
        @foreach($poliklinik as $poli)
            <x-card-layanan :layanan="$poli" />
        @endforeach
    </div>
</section>

<!-- {{-- Berita & Pengumuman --}}
<section class="berita">
    <h2>Berita Terbaru</h2>
    @foreach($berita as $item)
        <article>
            <h3>{{ $item['judul'] }}</h3>
            <time>{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}</time>
            <p>{{ Str::limit($item['ringkasan'], 150) }}</p>
        </article>
    @endforeach
</section> -->

@endsection