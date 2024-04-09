<?php

namespace App\Filament\Resources\RestrictionResource\Pages;

use App\Filament\Resources\RestrictionResource;
use App\Models\Restriction;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRestriction extends ViewRecord
{
    protected static string $resource = RestrictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Restriction::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
