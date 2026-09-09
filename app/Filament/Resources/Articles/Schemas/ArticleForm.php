<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Artikel')
                    ->maxLength(250)
                    ->required(),
                TextInput::make('author')
                    ->label('Penulis')
                    ->maxLength(50),
                Select::make('tags')
                    ->label('Kategori')
                    ->placeholder('Pilih Kategori Artikel')
                    ->options([
                        'Artikel Kesehatan' => 'Artikel Kesehatan',
                        // 'Berita' => 'Berita',
                    ])
                    ->required(),
                Toggle::make('is_active')
                    ->label('Aktif dan Tampilkan di halaman website')
                    ->default(false),
                FileUpload::make('image_path')
                    ->label('Thumbnail Artikel')
                    ->disk('public')
                    ->directory('articles')
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
                    ->helperText('Upload thumbnail artikel dengan format JPEG/JPG/PNG/WebP, ukuran maks 5 MB'),
                Textarea::make('shorts')
                    ->label('Ringkasan Artikel')
                    ->maxLength(250)
                    ->columnSpanFull(),
                RichEditor::make('isi')
                    ->label('Isi Konten Artikel')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
