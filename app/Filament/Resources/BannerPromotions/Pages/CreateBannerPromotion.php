<?php

namespace App\Filament\Resources\BannerPromotions\Pages;

use App\Filament\Resources\BannerPromotions\BannerPromotionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerPromotion extends CreateRecord
{
    protected static string $resource = BannerPromotionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
