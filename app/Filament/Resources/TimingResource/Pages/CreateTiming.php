<?php

namespace App\Filament\Resources\TimingResource\Pages;

use App\Filament\Resources\TimingResource;
use App\Models\Timing;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTiming extends CreateRecord
{
    protected static string $resource = TimingResource::class;

    protected function getActions(): array
    {
        return [
            Timing::backAction(),
        ];
    }
}
