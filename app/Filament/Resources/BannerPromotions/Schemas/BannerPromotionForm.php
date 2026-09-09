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
                    // ->helperText('Digunakan sebagai atribut alt="" pada gambar (untuk SEO & aksesibilitas).')
                    ->maxLength(255)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image_path')
                    ->label('Gambar Banner')
                    ->helperText('Upload gambar banner dengan format JPEG/JPG/PNG/WebP, ukuran maks 5 MB')
                    ->disk('public')
                    ->directory('banners')
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
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktif dan Tampilkan di halaman website')
                    // ->helperText('Aktifkan agar banner ini muncul di carousel halaman utama.')
                    ->default(false),
            ]);
    }
}
