<?php

namespace App\Filament\Resources\BannerPromotions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerPromotionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Banner')
                    ->helperText('Digunakan sebagai atribut alt="" pada gambar (untuk SEO & aksesibilitas).')
                    ->maxLength(255)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image_path')
                    ->label('Gambar Banner')
                    ->helperText('Upload gambar banner (JPG/PNG/WebP, maks 5 MB). Editor akan membantu Anda memotong gambar ke rasio 16:9. Gambar akan dikonversi ke WebP secara otomatis.')
                    ->disk('public')
                    ->directory('banners')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios(['16:9'])
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth(1920)
                    ->imageResizeTargetHeight(1080)
                    ->imageResizeMode('cover')
                    ->maxSize(5120) // 5 MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Tampilkan di Halaman Utama')
                    ->helperText('Aktifkan agar banner ini muncul di carousel halaman utama.')
                    ->default(true),
            ]);
    }
}
