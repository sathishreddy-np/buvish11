<?php

namespace App\Filament\Resources\TimingResource\Pages;

use App\Filament\Resources\TimingResource;
use App\Models\Timing;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTiming extends ViewRecord
{
    protected static string $resource = TimingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Timing::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
