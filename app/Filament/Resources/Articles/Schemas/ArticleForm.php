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
                    ->label('Aktif / Tampilkan')
                    ->default(false),
                FileUpload::make('thumbnail')
                    ->label('Thumbnail Artikel')
                    ->disk('public')
                    ->directory('articles')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios(['16:9'])
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth(1280)
                    ->imageResizeTargetHeight(720)
                    ->imageResizeMode('cover')
                    ->maxSize(5120) // 5 MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Upload thumbnail artikel (JPG/PNG/WebP, maks 5 MB). Editor akan membantu Anda memotong gambar ke rasio 16:9. Gambar akan dikonversi ke WebP secara otomatis.'),
                Textarea::make('shorts')
                    ->label('Ringkasan (Shorts)')
                    ->columnSpanFull(),
                RichEditor::make('isi')
                    ->label('Isi Konten')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
