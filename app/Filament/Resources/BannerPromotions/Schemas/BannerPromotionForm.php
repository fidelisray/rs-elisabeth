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
                    ->helperText('Format: JPG/PNG/WebP. Ukuran maks 2MB. Dimensi ideal: 1920×1080 px (16:9).')
                    ->disk('public')
                    ->directory('banners')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048) // 2MB dalam kilobytes
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
