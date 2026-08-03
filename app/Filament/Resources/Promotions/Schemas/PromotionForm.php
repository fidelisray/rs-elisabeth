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
                    ->label('Poster Promosi (Portrait, Maks 2 MB)')
                    ->disk('public')
                    ->directory('promotions')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048) // 2 MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->rules([new \App\Rules\ImagePromoSpec()])
                    ->validationMessages([
                        'max' => 'Ukuran foto tidak boleh melebihi 2 MB.',
                    ])
                    ->live()
                    ->afterStateUpdated(function (\Filament\Schemas\Components\Utilities\Set $set, $state, $component) {
                        if (empty($state)) {
                            return;
                        }

                        $rawState = $component->getRawState();

                        if (empty($rawState)) {
                            return;
                        }

                        $uploadedFile = is_array($rawState)
                            ? collect($rawState)->first()
                            : $rawState;

                        if (! ($uploadedFile instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)) {
                            return;
                        }

                        $realPath = $uploadedFile->getRealPath();

                        if (! $realPath || ! file_exists($realPath)) {
                            return;
                        }

                        $isValid = true;

                        (new \App\Rules\ImagePromoSpec())->validate(
                            'image_path',
                            $uploadedFile,
                            function (string $msg) use (&$isValid) {
                                $isValid = false;

                                \Filament\Notifications\Notification::make('promo-image-error')
                                    ->title('Foto Tidak Sesuai Ketentuan')
                                    ->body($msg)
                                    ->danger()
                                    ->persistent()
                                    ->send();
                            }
                        );

                        if ($isValid) {
                            $component->getLivewire()->dispatch('close-notification', id: 'promo-image-error');

                            $info = @getimagesize($realPath);
                            [$w, $h] = $info ?? [0, 0];
                            $kb = $uploadedFile->getSize()
                                ? round($uploadedFile->getSize() / 1024)
                                : '?';

                            \Filament\Notifications\Notification::make('promo-image-success')
                                ->title('Foto Sesuai Ketentuan ✓')
                                ->body("Resolusi {$w}×{$h}px · {$kb} KB · Rasio Portrait")
                                ->success()
                                ->duration(5000)
                                ->send();
                        }
                    })
                    ->helperText('Format: JPG, PNG, WebP · Rasio Portrait (misal: 1127x1600 px) · Maks 2 MB')
                    ->columnSpanFull(),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
