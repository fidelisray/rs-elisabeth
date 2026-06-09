@extends('layouts.app')

@section('title', 'Daftar Dokter')
@section('meta_description', 'Temukan dokter spesialis terbaik di RS Sehat')

@section('content')

{{-- Header halaman --}}
<section style="background:#f8f9fa; padding: 2rem 0;">
    <div style="max-width:1100px; margin:0 auto; padding:0 1.5rem;">
        <h1 style="margin:0 0 0.5rem;">Daftar Dokter</h1>
        <p style="color:#666; margin:0;">Temukan dokter spesialis sesuai kebutuhan Anda</p>
    </div>
</section>

{{-- Form Filter --}}
<section style="max-width:1100px; margin:2rem auto; padding:0 1.5rem;">
    <form method="GET" action="{{ route('staff.index') }}" style="display:flex; gap:1rem; flex-wrap:wrap;">

        <input
            type="text"
            name="nama"
            value="{{ $filters['nama'] ?? '' }}"
            placeholder="Cari nama dokter..."
            style="flex:1; min-width:200px; padding:0.6rem 1rem; border:1px solid #ddd; border-radius:6px;"
        >

        <select
            name="spesialisasi"
            style="flex:1; min-width:200px; padding:0.6rem 1rem; border:1px solid #ddd; border-radius:6px;"
        >
            <option value="">Semua Spesialisasi</option>
            <option value="kardiologi"     {{ ($filters['spesialisasi'] ?? '') === 'kardiologi'     ? 'selected' : '' }}>Kardiologi</option>
            <option value="penyakit-dalam" {{ ($filters['spesialisasi'] ?? '') === 'penyakit-dalam' ? 'selected' : '' }}>Penyakit Dalam</option>
            <option value="bedah"          {{ ($filters['spesialisasi'] ?? '') === 'bedah'          ? 'selected' : '' }}>Bedah</option>
            <option value="anak"           {{ ($filters['spesialisasi'] ?? '') === 'anak'           ? 'selected' : '' }}>Anak</option>
            <option value="kandungan"      {{ ($filters['spesialisasi'] ?? '') === 'kandungan'      ? 'selected' : '' }}>Kandungan</option>
        </select>

        <button
            type="submit"
            style="padding:0.6rem 1.5rem; background:#2563eb; color:#fff; border:none; border-radius:6px; cursor:pointer;"
        >
            Cari
        </button>

        {{-- Tampilkan tombol Reset hanya jika ada filter aktif --}}
        @if(!empty($filters))
            
                href="{{ route('staff.index') }}"
                style="padding:0.6rem 1.5rem; background:#e5e7eb; color:#333; border-radius:6px; text-decoration:none;"
            >
                Reset
            </a>
        @endif

    </form>
</section>

{{-- Grid Daftar Dokter --}}
<section style="max-width:1100px; margin:0 auto 3rem; padding:0 1.5rem;">

    @if(empty($dokter))

        {{-- Kondisi: API gagal atau tidak ada hasil --}}
        <div style="text-align:center; padding:4rem 0; color:#888;">
            <p style="font-size:1.2rem;">Tidak ada dokter ditemukan.</p>
            @if(!empty($filters))
                <p>Coba ubah atau hapus filter pencarian.</p>
            @else
                <p>Data dokter sedang tidak tersedia, silakan coba beberapa saat lagi.</p>
            @endif
        </div>

    @else

        <p style="color:#888; margin-bottom:1.5rem;">
            Menampilkan {{ count($dokter) }} dokter
            @if(!empty($filters['spesialisasi']))
                dengan spesialisasi <strong>{{ $filters['spesialisasi'] }}</strong>
            @endif
            @if(!empty($filters['nama']))
                dengan nama <strong>{{ $filters['nama'] }}</strong>
            @endif
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:1.5rem;">
            @foreach($dokter as $item)
                <div style="border:1px solid #e5e7eb; border-radius:10px; overflow:hidden; background:#fff;">

                    {{-- Foto Dokter --}}
                    <div style="height:200px; background:#f3f4f6; overflow:hidden;">
                        @if(!empty($item['foto_url']))
                            <img
                                src="{{ $item['foto_url'] }}"
                                alt="Foto {{ $item['nama'] }}"
                                style="width:100%; height:100%; object-fit:cover;"
                            >
                        @else
                            {{-- Placeholder jika tidak ada foto --}}
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#aaa; font-size:3rem;">
                                &#9786;
                            </div>
                        @endif
                    </div>

                    {{-- Info Dokter --}}
                    <div style="padding:1rem;">
                        <h3 style="margin:0 0 0.3rem; font-size:1rem;">
                            {{ $item['nama'] }}
                        </h3>
                        <p style="margin:0 0 0.5rem; color:#2563eb; font-size:0.9rem;">
                            {{ $item['spesialisasi'] }}
                        </p>
                        @if(!empty($item['jadwal']))
                            <p style="margin:0 0 1rem; color:#888; font-size:0.85rem;">
                                &#128197; {{ $item['jadwal'] }}
                            </p>
                        @endif

                        
                            href="{{ route('staff.detail', ['id' => $item['id']]) }}"
                            style="display:inline-block; padding:0.5rem 1rem; background:#2563eb; color:#fff; border-radius:6px; text-decoration:none; font-size:0.9rem;"
                        >
                            Lihat Profil
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Pagination (jika API mengembalikan data meta pagination) --}}
        @if(!empty($meta['last_page']) && $meta['last_page'] > 1)
            <div style="margin-top:2rem; display:flex; gap:0.5rem; justify-content:center;">
                @for($i = 1; $i <= $meta['last_page']; $i++)
                    
                        href="{{ route('staff.index', array_merge($filters, ['page' => $i])) }}"
                        style="
                            padding:0.5rem 0.9rem;
                            border-radius:6px;
                            text-decoration:none;
                            border:1px solid #ddd;
                            background: {{ ($filters['page'] ?? 1) == $i ? '#2563eb' : '#fff' }};
                            color: {{ ($filters['page'] ?? 1) == $i ? '#fff' : '#333' }};
                        "
                    >
                        {{ $i }}
                    </a>
                @endfor
            </div>
        @endif

    @endif

</section>

@endsection