<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (\Filament\Forms\Set $set, \Filament\Forms\Get $get, ?string $operation, ?string $state) {
                        if (($operation === 'create' || empty($get('slug'))) && filled($state)) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->placeholder('Klik pada form akan terisi otomatis')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Dapat diedit jika diperlukan'),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->label('Gambar Berita')
                    ->disk('public')
                    ->directory('news')
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
                    ->helperText('Upload gambar berita dengan format JPEG/JPG/PNG/WebP, ukuran maks 5 MB'),
                Toggle::make('is_published')
                    ->label('Aktif dan Tampilkan di halaman website')
                    ->default(false),
            ]);
    }
}
