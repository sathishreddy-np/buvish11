<?php

namespace App\Filament\Resources\AvailabilityResource\Pages;

use App\Filament\Resources\AvailabilityResource;
use App\Models\Availability;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAvailability extends ViewRecord
{
    protected static string $resource = AvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Availability::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
