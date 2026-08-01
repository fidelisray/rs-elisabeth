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
                    ->options([
                        'Artikel Kesehatan' => 'Artikel Kesehatan',
                        'Berita' => 'Berita',
                    ])
                    ->required(),
                Toggle::make('is_active')
                    ->label('Aktif / Tampilkan')
                    ->default(false),
                /*
                // KODE LAMA (Tanpa Disk Public, menyimpan ke storage/app/private)
                // Jangan dihapus, uncomment jika ingin kembali ke konfigurasi bawaan
                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->directory('articles')
                    ->image()
                    ->maxSize(5120), // 5MB
                */
                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->directory('articles')
                    ->image()
                    ->maxSize(5120), // 5MB
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
