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
                /*
                // KODE LAMA (Tanpa Disk Public, menyimpan ke storage/app/private)
                // Jangan dihapus, uncomment jika ingin kembali ke konfigurasi bawaan
                FileUpload::make('image_path')
                    ->image(),
                */
                FileUpload::make('image_path')
                    ->disk('public')
                    ->directory('news')
                    ->image(),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
