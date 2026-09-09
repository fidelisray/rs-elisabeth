<?php

namespace App\Filament\Resources\FacilityServices\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class FacilityServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $get, ?string $operation, ?string $state) {
                                if (($operation === 'create' || empty($get('slug'))) && filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->placeholder('Klik pada form akan terisi otomatis')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Dapat diedit jika diperlukan'),

                        Select::make('category')
                            ->options([
                                'Layanan Medis' => 'Layanan Medis',
                                'Layanan Penunjang' => 'Layanan Penunjang',
                                'Layanan 24 Jam' => 'Layanan 24 Jam',
                                'Layanan Spesialis' => 'Layanan Spesialis',
                                'Layanan Intensif' => 'Layanan Intensif',
                                'Diagnostik' => 'Diagnostik',
                                'Unggulan' => 'Unggulan'
                            ])
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('short_description')
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->helperText('Teks singkat yang akan muncul di Carousel Halaman Utama.'),

                        RichEditor::make('description')
                            ->columnSpanFull()
                            ->helperText('Deskripsi lengkap yang muncul saat fasilitas di-klik di halaman Fasilitas & Layanan.'),

                        TagsInput::make('highlights')
                            ->columnSpanFull()
                            ->separator(',')
                            ->helperText('Masukkan poin-poin unggulan (tekan Enter/Koma untuk menambah). Akan muncul sebagai badge centang.'),
                    ]),

                Section::make('Gambar Fasilitas')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Gambar')
                            ->disk('public')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatioOptions([
                                '1:1',
                                '4:3',
                                '16:9'
                            ])
                            ->automaticallyResizeImagesMode('cover')
                            ->helperText('Upload gambar dengan format JPEG/JPG/PNG/WebP, ukuran maks 5 MB')
                            ->required()
                            ->directory('facility_services')
                            ->columnSpanFull(),
                    ]),
                
                Section::make('Call to Action (CTA)')
                    ->columns(2)
                    ->schema([
                        TextInput::make('wa_link_text')
                            ->label('Teks WhatsApp')
                            ->placeholder('misal: Konsultasi Gizi')
                            ->maxLength(255),
                            
                        TextInput::make('wa_link_url')
                            ->label('URL / Nomor WhatsApp')
                            ->placeholder('misal: https://wa.me/6285600600870')
                            ->maxLength(255),
                            
                        Toggle::make('has_appointment_cta')
                            ->label('Tampilkan Tombol "Buat Janji"?')
                            ->default(false)
                            ->helperText('Akan mengarah ke portal registrasi online.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Pengaturan Tampilan')
                    ->description('Atur urutan tampil dan visibilitas fasilitas ini di halaman frontend.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Semakin kecil angkanya, semakin awal tampil. Default: 0.'),

                        Toggle::make('is_active')
                            ->label('Aktif dan Tampilkan di halaman website')
                            ->default(false)
                            ->helperText('Non-aktifkan untuk menyembunyikan fasilitas ini dari halaman publik tanpa menghapus data.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
