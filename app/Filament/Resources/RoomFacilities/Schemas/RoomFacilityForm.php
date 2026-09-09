<?php

namespace App\Filament\Resources\RoomFacilities\Schemas;

use Filament\Forms\Components\CheckboxList;
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
                            ->placeholder('Klik pada form akan terisi otomatis')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->helperText('Dapat diedit jika diperlukan'),

                        Select::make('category')
                            ->label('Kategori Ruangan')
                            ->placeholder('Pilih Kategori Ruangan')
                            ->options([
                                'premium'  => 'Premium (President Suite, Suites, Executive)',
                                'standard' => 'Standard (VIP, Kelas I, II, III)',
                            ])
                            ->required()
                            ->helperText('Menentukan di section mana ruangan ini akan ditampilkan'),

                        \Filament\Forms\Components\Hidden::make('sort_order')
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Aktif dan Tampilkan di Halaman')
                            ->default(false)
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
                            ->numeric()
                            ->suffix('m²')
                            ->placeholder('Contoh: 40')
                            ->maxValue(999),

                        TextInput::make('bed_count')
                            ->label('Jumlah Tempat Tidur')
                            ->numeric()
                            ->suffix('Bed')
                            ->placeholder('Contoh: 1')
                            ->maxValue(99),

                        TextInput::make('max_companion')
                            ->label('Maks. Penunggu')
                            ->numeric()
                            ->suffix('Orang')
                            ->placeholder('Contoh: 2')
                            ->maxValue(99),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 3: Deskripsi
                // ─────────────────────────────────────────────
                Section::make('Deskripsi Ruangan')
                    ->schema([

                        Textarea::make('tagline')
                            ->label('Tagline / Deskripsi Singkat')
                            ->placeholder('Deskripsi singkat sebagai Highlight untuk ruangan ini...')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi Lengkap')
                            ->placeholder('Deskripsi lengkap ruangan terkait fasilitas, keunggulan, atau layanan lainnya...')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 4: Foto Ruangan
                // ─────────────────────────────────────────────
                Section::make('Foto Ruangan')
                    ->description('Upload foto ruangan dengan format landscape (16:9)')
                    ->schema([

                        FileUpload::make('image_path')
                            ->label('Foto Ruangan')
                            ->disk('public')
                            ->directory('room-facilities')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatioOptions(['16:9'])
                            // ->imageAspectRatio('16:9')
                            // ->automaticallyCropImagesToAspectRatio()

                            ->automaticallyResizeImagesToWidth(1920)
                            ->automaticallyResizeImagesToHeight(1080)
                            ->automaticallyResizeImagesMode('cover')
                            ->maxSize(5120) // 5 MB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload foto dengan format JPEG/JPG/PNG/WebP, ukuran maksimal 5 MB, Resolusi ideal 1920x1080')
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 5: Fasilitas (Amenities)
                // ─────────────────────────────────────────────
                Section::make('Daftar Fasilitas')
                    ->description('Kelompokkan fasilitas dalam grup (contoh: "Kamar & Ruangan", "Layanan Eksklusif")...')
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
                    ->description('Highlight keunggulan utama yang dimiliki ruangan ini')
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
                                            'fa-solid fa-bath' => 'Kamar Mandi',
                                            'fa-solid fa-snowflake' => 'AC / Pendingin Ruangan',
                                            'fa-solid fa-tv' => 'TV / Hiburan',
                                            'fa-solid fa-wifi' => 'WiFi / Internet',
                                            'fa-solid fa-mug-hot' => 'Dispenser / Teko Elektrik',
                                            'fa-solid fa-utensils' => 'Meja / Lemari Pribadi',
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
                Section::make('Pengaturan Pesan Whatsapp')
                    ->description('Tentukan pesan default yang akan secara otomatis terketik saat pengunjung menekan tombol WhatsApp di bagian ruangan ini')
                    ->schema([

                        TextInput::make('whatsapp_text')
                            ->label('Teks Pesan WhatsApp')
                            ->placeholder('Contoh: Halo, saya ingin informasi President Suite')
                            ->maxLength(255)
                            // ->helperText('Pesan ini akan menjadi default message saat pengunjung mengklik tombol WhatsApp di halaman ruangan ini.')
                            ->columnSpanFull(),
                    ]),

                // ─────────────────────────────────────────────
                // SECTION 8: Perbandingan Fasilitas
                // ─────────────────────────────────────────────
                Section::make('Fasilitas Yang Didapatkan')
                    ->description('Centang fasilitas standar yang ada, dan tambahkan fasilitas dengan spesifikasi khusus jika diperlukan.')
                    ->schema([

                        CheckboxList::make('comparison_features.boolean_features')
                            ->label('Fasilitas Standar (Ya/Tidak)')
                            ->options([
                                'Kamar mandi private' => 'Kamar mandi private',
                                'Ruang tamu / sofa' => 'Ruang tamu / sofa',
                                'Kulkas' => 'Kulkas',
                                'Kipas Angin' => 'Kipas Angin',
                                'Akomodasi BPJS Kesehatan' => 'Akomodasi BPJS Kesehatan',
                                'Tempat Tidur Penunggu Pasien' => 'Tempat Tidur Penunggu Pasien',
                                'Lemari' => 'Lemari',
                                'Meja' => 'Meja',
                            ])
                            ->columns(3)
                            ->columnSpanFull(),

                        Repeater::make('comparison_features.text_features')
                            ->label('Fasilitas Tambahan')
                            ->schema([

                                Select::make('feature_name')
                                    ->label('Nama Fasilitas')
                                    ->options([
                                        'Air Conditioner (AC)' => 'Air Conditioner (AC)',
                                        'Televisi' => 'Televisi',
                                        'Wi-Fi Internet' => 'Wi-Fi Internet',
                                        'Jumlah bed per kamar' => 'Jumlah bed per kamar',
                                        'Perawat personal' => 'Perawat personal',
                                    ])
                                    ->searchable()
                                    ->createOptionForm([
                                        TextInput::make('feature_name')
                                            ->label('Nama Fasilitas Baru')
                                            ->required(),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                        return $data['feature_name'];
                                    })
                                    ->required(),

                                TextInput::make('feature_value')
                                    ->label('Spesifikasi')
                                    ->placeholder('contoh: 55" Smart TV, Central, Bersama')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('+ Tambah Fasilitas Tambahan')
                            ->defaultItems(0)
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}
