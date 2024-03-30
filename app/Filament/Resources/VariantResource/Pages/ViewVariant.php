<?php

namespace App\Filament\Resources\VariantResource\Pages;

use App\Filament\Resources\VariantResource;
use App\Models\Variant;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVariant extends ViewRecord
{
    protected static string $resource = VariantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Variant::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
