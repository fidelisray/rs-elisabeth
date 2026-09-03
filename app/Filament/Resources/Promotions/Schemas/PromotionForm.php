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
                    ->helperText('Upload poster promosi (JPG/PNG/WebP, maks 5 MB). Editor akan membantu Anda memotong gambar ke rasio portrait 4:5. Gambar akan dikonversi ke WebP secara otomatis.')
                    ->columnSpanFull(),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
