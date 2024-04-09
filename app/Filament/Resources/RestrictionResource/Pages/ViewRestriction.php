<?php

namespace App\Filament\Resources\RestrictionResource\Pages;

use App\Filament\Resources\RestrictionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRestriction extends ViewRecord
{
    protected static string $resource = RestrictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
