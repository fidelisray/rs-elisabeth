<?php

namespace App\Filament\Resources\RoomFacilities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class RoomFacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ─────────────────────────────────────────────
                // SECTION 1: Informasi Utama
                // ─────────────────────────────────────────────
                Section::make('Informasi Utama')
                    ->columns(2)
                    ->schema([

                        TextInput::make('name')
                            ->label('Nama Ruangan')
                            ->placeholder('President Suite, VIP, Kelas I...')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                // Auto-generate slug dari name
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->label('URL Identifier')
                            ->placeholder('contoh-nama-ruangan')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->helperText('Terisi otomatis dari Nama Ruangan. Bisa diedit manual jika perlu.'),

                        Select::make('category')
                            ->label('Kategori Ruangan')
                            ->placeholder('Pilih Kategori Ruangan')
                            ->options([
                                'premium'  => 'Premium (President Suite, Suites, Executive)',
                                'standard' => 'Standard (VIP, Kelas I, II, III)',
                            ])
                            ->required()
                            ->helperText('Menentukan di seksi mana ruangan ini ditampilkan di halaman.'),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka kecil = tampil lebih awal. Contoh: 1, 2, 3 ...'),

                        Toggle::make('is_active')
                            ->label('Aktif / Tampilkan di Halaman')
                            ->default(true)
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 2: Spesifikasi Kamar
                // ─────────────────────────────────────────────
                Section::make('Spesifikasi Kamar')
                    ->columns(3)
                    ->schema([

                        TextInput::make('room_size')
                            ->label('Luas Kamar')
                            ->placeholder('Contoh: ~40 m²')
                            ->maxLength(50),

                        TextInput::make('bed_count')
                            ->label('Jumlah Tempat Tidur')
                            ->placeholder('Contoh: 1 Tempat Tidur')
                            ->maxLength(50),

                        TextInput::make('max_companion')
                            ->label('Maks. Penunggu')
                            ->placeholder('Contoh: Max 2 Penunggu')
                            ->maxLength(50),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 3: Konten
                // ─────────────────────────────────────────────
                Section::make('Konten Ruangan')
                    ->schema([

                        Textarea::make('tagline')
                            ->label('Tagline / Deskripsi Singkat')
                            ->placeholder('Deskripsi singkat 1-2 kalimat yang muncul di card ruangan...')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi Lengkap')
                            ->placeholder('Deskripsi lengkap ruangan...')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 4: Foto Ruangan
                // ─────────────────────────────────────────────
                Section::make('Foto Ruangan')
                    ->description('Upload foto ruangan dengan format landscape (16:9). Contoh resolusi: 1280×720, 1920×1080. Ukuran maksimal 1 MB.')
                    ->schema([

                        FileUpload::make('image_path')
                            ->label('Foto Ruangan')
                            ->disk('public')
                            ->directory('room-facilities')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatioOptions(['16:9'])
                            ->imageAspectRatio('16:9')
                            ->automaticallyCropImagesToAspectRatio()
                            ->automaticallyResizeImagesToWidth(1920)
                            ->automaticallyResizeImagesToHeight(1080)
                            ->automaticallyResizeImagesMode('cover')
                            ->maxSize(5120) // 5 MB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload foto ruangan (JPG/PNG/WebP, maks 5 MB). Editor akan membantu Anda memotong gambar ke rasio 16:9. Gambar akan dikonversi ke WebP secara otomatis.')
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 5: Fasilitas (Amenities)
                // ─────────────────────────────────────────────
                Section::make('Daftar Fasilitas')
                    ->description('Kelompokkan fasilitas dalam grup (misal: "Kamar & Ruangan", "Layanan Eksklusif").')
                    ->schema([

                        Repeater::make('amenities')
                            ->label('Grup Fasilitas')
                            ->schema([

                                TextInput::make('group')
                                    ->label('Nama Grup')
                                    ->placeholder('Contoh: Kamar & Ruangan')
                                    ->required()
                                    ->maxLength(100),

                                TagsInput::make('items')
                                    ->label('Item Fasilitas')
                                    ->placeholder('Ketik item lalu Enter...')
                                    ->helperText('Tekan Enter atau koma untuk menambah item fasilitas.')
                                    ->separator(','),
                            ])
                            ->addActionLabel('+ Tambah Grup Fasilitas')
                            ->defaultItems(0)
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 6: Highlight Tags
                // ─────────────────────────────────────────────
                Section::make('Highlight Tags')
                    ->description('Tags ringkas yang muncul di bagian bawah card (ikon + label singkat).')
                    ->schema([

                        Repeater::make('highlight_tags')
                            ->label('Highlight Tags')
                            ->schema([

                                Select::make('icon')
                                    ->label('Pilih Ikon')
                                    ->options([
                                        'Fasilitas & Kenyamanan' => [
                                            'fa-solid fa-bed' => 'Tempat Tidur',
                                            'fa-solid fa-couch' => 'Sofa / Ruang Tamu',
                                            'fa-solid fa-bath' => 'Kamar Mandi Dalam',
                                            'fa-solid fa-snowflake' => 'AC / Pendingin Ruangan',
                                            'fa-solid fa-tv' => 'TV / Hiburan',
                                            'fa-solid fa-wifi' => 'WiFi / Internet',
                                            'fa-solid fa-mug-hot' => 'Pembuat Kopi & Teh',
                                            'fa-solid fa-utensils' => 'Meja Makan / Dapur',
                                            'fa-solid fa-temperature-arrow-down' => 'Kulkas',
                                        ],
                                        'Pelayanan & Medis' => [
                                            'fa-solid fa-user-nurse' => 'Perawat 24 Jam',
                                            'fa-solid fa-stethoscope' => 'Peralatan Medis Lengkap',
                                            'fa-solid fa-heart-pulse' => 'Pemantauan Pasien',
                                            'fa-solid fa-bell' => 'Bel Panggilan Darurat',
                                            'fa-solid fa-wheelchair' => 'Akses Kursi Roda',
                                        ],
                                        'Keunggulan & Label' => [
                                            'fa-solid fa-crown' => 'Mahkota (Premium / VIP)',
                                            'fa-solid fa-star' => 'Bintang (Populer / Favorit)',
                                            'fa-solid fa-award' => 'Terbaik / Rekomendasi',
                                            'fa-solid fa-thumbs-up' => 'Sangat Direkomendasikan',
                                            'fa-solid fa-shield-heart' => 'Keamanan Ekstra',
                                            'fa-solid fa-hands-holding-child' => 'Ramah Anak & Keluarga',
                                        ]
                                    ])
                                    ->searchable()
                                    ->required(),

                                TextInput::make('label')
                                    ->label('Label Tag')
                                    ->placeholder('Contoh: Kamar Terluas')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->columns(2)
                            ->addActionLabel('+ Tambah Highlight Tag')
                            ->defaultItems(0)
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 7: CTA / WhatsApp
                // ─────────────────────────────────────────────
                Section::make('Call-to-Action (WhatsApp)')
                    ->description('Teks pesan yang akan dikirim saat pengunjung klik tombol WhatsApp di halaman ruangan ini.')
                    ->schema([

                        TextInput::make('whatsapp_text')
                            ->label('Teks Pesan WhatsApp')
                            ->placeholder('Contoh: Halo, saya ingin informasi President Suite')
                            ->maxLength(255)
                            ->helperText('Teks ini akan di-encode URL otomatis di frontend.')
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
