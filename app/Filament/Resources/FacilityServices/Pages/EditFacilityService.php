<?php

namespace App\Filament\Resources\FacilityServices\Pages;

use App\Filament\Resources\FacilityServices\FacilityServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFacilityService extends EditRecord
{
    protected static string $resource = FacilityServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
