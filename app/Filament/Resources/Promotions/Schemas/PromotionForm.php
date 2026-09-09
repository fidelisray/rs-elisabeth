<?php

namespace App\Filament\Resources\Promotions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PromotionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->maxLength(255)
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->label('Poster Promosi')
                    ->disk('public')
                    ->directory('promotions')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatioOptions(['4:5', '3:4'])
                    // ->imageAspectRatio('4:5')
                    // ->automaticallyCropImagesToAspectRatio()

                    ->automaticallyResizeImagesToWidth(1200)
                    ->automaticallyResizeImagesToHeight(1500)
                    ->automaticallyResizeImagesMode('cover')
                    ->maxSize(5120) // 5 MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Upload poster promosi dengan format JPEG/JPG/PNG/WebP, ukuran maks 5 MB')
                    ->columnSpanFull(),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Toggle::make('is_active')
                    ->label('Aktif dan Tampilkan di halaman website')
                    ->default(false),
            ]);
    }
}
