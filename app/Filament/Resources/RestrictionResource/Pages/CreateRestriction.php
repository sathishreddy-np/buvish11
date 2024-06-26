<?php

namespace App\Filament\Resources\RestrictionResource\Pages;

use App\Filament\Resources\RestrictionResource;
use App\Models\Restriction;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRestriction extends CreateRecord
{
    protected static string $resource = RestrictionResource::class;

    protected function getActions(): array
    {
        return [
            Restriction::backAction(),
        ];
    }

}
