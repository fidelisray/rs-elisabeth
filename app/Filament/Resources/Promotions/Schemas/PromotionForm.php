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
                /*
                // KODE LAMA (Tanpa Disk Public, menyimpan ke storage/app/private)
                // Jangan dihapus, uncomment jika ingin kembali ke konfigurasi bawaan
                FileUpload::make('image_path')
                    ->image(),
                */
                FileUpload::make('image_path')
                    ->disk('public')
                    ->directory('promotions')
                    ->image(),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
