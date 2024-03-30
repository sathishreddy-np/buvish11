<?php

namespace App\Filament\Resources\AttributeValueResource\Pages;

use App\Filament\Resources\AttributeValueResource;
use App\Models\AttributeValue;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttributeValue extends ViewRecord
{
    protected static string $resource = AttributeValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            AttributeValue::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
