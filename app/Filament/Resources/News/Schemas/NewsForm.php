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
                    ->required(),
                TextInput::make('slug')
                    ->required(),
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
                    ->imageAspectRatio('16:9')
                    ->automaticallyCropImagesToAspectRatio()
                    ->automaticallyResizeImagesToWidth(1280)
                    ->automaticallyResizeImagesToHeight(720)
                    ->automaticallyResizeImagesMode('cover')
                    ->maxSize(5120) // 5 MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Upload gambar berita (JPG/PNG/WebP, maks 5 MB). Editor akan membantu Anda memotong gambar ke rasio 16:9. Gambar akan dikonversi ke WebP secara otomatis.'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
