<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten Artikel')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([

                        TextInput::make('judul')
                            ->label('Judul Artikel')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (\Filament\Forms\Set $set, \Filament\Forms\Get $get, ?string $operation, ?string $state) {
                                if (($operation === 'create' || empty($get('slug'))) && filled($state)) {
                                    $set('slug', \Illuminate\Support\Str::slug($state));
                                }
                            }),
                        
                        TextInput::make('slug')
                            ->label('Identifier')
                            ->placeholder('Klik pada form dan teks akan terisi otomatis')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Dapat diedit jika diperlukan'),

                        Select::make('tags')
                            ->label('Kategori')
                            ->placeholder('Pilih Kategori Artikel')
                            ->options([
                                'Artikel Kesehatan' => 'Artikel Kesehatan',
                                // 'Berita' => 'Berita',
                            ])
                            ->required(),
                            
                        TextInput::make('author')
                            ->label('Author')
                            ->required()
                            ->maxLength(50)
                            ->columnSpanFull(),


                        Textarea::make('shorts')
                            ->label('Ringkasan Artikel')
                            ->maxLength(250)
                            ->columnSpanFull()
                            ->required(),

                        RichEditor::make('content')
                            ->label('Isi Konten Artikel')
                            ->columnSpanFull()
                            ->required(),
                    ]),

                Section::make('Thumbnail Article')
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('image_path')
                            // ->label('Thumbnail Artikel')
                            ->required()
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
                    ]),
                
                Section::make('Publish')
                    ->columnSpanFull()
                    ->description('Atur apakah artikel ini akan ditampilkan pada halaman website')  
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif dan Tampilkan di halaman website')
                            ->default(false)
                            ->helperText('Non-aktifkan untuk menyembunyikan artikel ini dari halaman website tanpa menghapus datanya')
                            ->columnSpanFull(),
                    ]),
                
                
            ]);
    }
}
