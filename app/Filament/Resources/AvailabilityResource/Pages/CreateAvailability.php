<?php

namespace App\Filament\Resources\AvailabilityResource\Pages;

use App\Filament\Resources\AvailabilityResource;
use App\Models\Availability;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAvailability extends CreateRecord
{
    protected static string $resource = AvailabilityResource::class;

    protected function getActions(): array
    {
        return [
            Availability::backAction(),
        ];
    }

}
