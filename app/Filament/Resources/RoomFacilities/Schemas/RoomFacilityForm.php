<?php

namespace App\Filament\Resources\RoomFacilities\Schemas;

use App\Rules\ImageRoomSpec;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
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
                            ->placeholder('Contoh: President Suite, VIP, Kelas I')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                // Auto-generate slug dari name
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->label('Slug (URL Identifier)')
                            ->placeholder('auto-terisi dari nama')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->helperText('Terisi otomatis dari Nama Ruangan. Bisa diedit manual jika perlu.'),

                        Select::make('category')
                            ->label('Kategori Ruangan')
                            ->options([
                                'premium'  => '🏆 Premium (President Suite, Suites, Executive)',
                                'standard' => '🛏️ Standard (VIP, Kelas I, II, III)',
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
                            ->label('Foto Ruangan (16:9 Landscape, Maks 1 MB)')
                            ->disk('public')
                            ->directory('room-facilities')
                            ->image()
                            ->imageEditor()
                            ->maxSize(1024) // 1 MB = 1024 KB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            // ──────────────────────────────────────────────────────────────
                            // Gunakan custom Rule class (ImageRoomSpec) agar validator
                            // menerima object UploadedFile secara langsung (bukan string UUID).
                            // Ini adalah satu-satunya cara agar real-time validation berjalan
                            // karena Livewire 3 tidak lagi meng-expose path file via $state.
                            // ──────────────────────────────────────────────────────────────
                            ->rules([new ImageRoomSpec()])
                            ->validationMessages([
                                'max' => 'Ukuran foto tidak boleh melebihi 1 MB.',
                            ])
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state, $component) {
                                // ── Root Cause Analysis ─────────────────────────────────────────────
                                // $state yang dikirim ke closure ini adalah "cast state" (sudah
                                // diproses oleh FileUploadStateCast) sehingga isinya bukan
                                // TemporaryUploadedFile object, melainkan bisa berupa string/null.
                                //
                                // Solusi yang benar: gunakan $component->getRawState() yang
                                // mengembalikan langsung dari Livewire property dan masih berisi
                                // TemporaryUploadedFile object (sebelum proses cast).
                                // ──────────────────────────────────────────────────────────────────

                                if (empty($state)) {
                                    return;
                                }

                                // Ambil raw state langsung dari Livewire (berisi TemporaryUploadedFile)
                                $rawState = $component->getRawState();

                                if (empty($rawState)) {
                                    return;
                                }

                                // Normalisasi: rawState bisa array atau single object
                                $uploadedFile = is_array($rawState)
                                    ? collect($rawState)->first()
                                    : $rawState;

                                // Pastikan ini benar-benar TemporaryUploadedFile dari Livewire
                                if (! ($uploadedFile instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)) {
                                    return;
                                }

                                // getRealPath() pada TemporaryUploadedFile memanggil
                                // $this->storage->path($this->path) — ini adalah path absolut
                                // yang VALID dan dapat dibaca oleh getimagesize()
                                $realPath = $uploadedFile->getRealPath();

                                if (! $realPath || ! file_exists($realPath)) {
                                    return;
                                }

                                // Jalankan rule ImageRoomSpec secara manual
                                $isValid = true;

                                (new \App\Rules\ImageRoomSpec())->validate(
                                    'image_path',
                                    $uploadedFile,
                                    function (string $msg) use (&$isValid) {
                                        $isValid = false;

                                        // ❌ Notifikasi merah dengan ID tetap 'room-image-error'.
                                        // Menggunakan ID tetap memastikan notification sebelumnya
                                        // DIGANTIKAN (bukan ditumpuk) ketika user upload ulang.
                                        Notification::make('room-image-error')
                                            ->title('Foto Tidak Sesuai Ketentuan')
                                            ->body($msg)
                                            ->danger()
                                            ->persistent()
                                            ->send();
                                    }
                                );

                                if ($isValid) {
                                    // ✅ Semua syarat terpenuhi:
                                    // 1. Tutup notification error sebelumnya menggunakan browser event
                                    //    yang di-listen oleh Filament: 'close-notification' (window event)
                                    //    Ini ditemukan di Notification.php baris 364:
                                    //    'x-on:close-notification.window' => "if ($event.detail.id == 'X') close()"
                                    $component->getLivewire()->dispatch('close-notification', id: 'room-image-error');

                                    // 2. Tampilkan notification sukses
                                    $info = @getimagesize($realPath);
                                    [$w, $h] = $info ?? [0, 0];
                                    $kb = $uploadedFile->getSize()
                                        ? round($uploadedFile->getSize() / 1024)
                                        : '?';

                                    Notification::make('room-image-success')
                                        ->title('Foto Sesuai Ketentuan ✓')
                                        ->body("Resolusi {$w}×{$h}px · {$kb} KB · Rasio 16:9")
                                        ->success()
                                        ->duration(5000)
                                        ->send();
                                }
                            })
                            ->helperText('Format: JPG, PNG, WebP · Rasio 16:9 · Resolusi: 1280×720 atau 1920×1080 · Maks 1 MB')
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
