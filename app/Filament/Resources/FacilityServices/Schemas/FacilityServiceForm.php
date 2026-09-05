<?php

namespace App\Filament\Resources\FacilityServices\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class FacilityServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                    Section::make('Informasi Dasar')->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

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
                            ->required(),

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
                    ])->columnSpan(2),

                    Grid::make(1)->schema([
                        Section::make('Gambar Fasilitas')->schema([
                            FileUpload::make('icon_path')
                                ->label('Gambar')
                                ->image()
                                ->imageEditor()
                                ->imageEditorAspectRatioOptions([
                                    '1:1',
                                    '4:3',
                                    '16:9'
                                ])
                                ->automaticallyResizeImagesMode('cover')
                                ->required()
                                ->directory('facility_services'),
                        ]),
                        
                        Section::make('Call to Action (CTA)')->schema([
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
                                ->helperText('Akan mengarah ke portal registrasi online.'),
                        ])
                    ])->columnSpan(1),
                ]),
            ]);
    }
}
