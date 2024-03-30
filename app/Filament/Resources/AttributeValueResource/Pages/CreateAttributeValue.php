<?php

namespace App\Filament\Resources\AttributeValueResource\Pages;

use App\Filament\Resources\AttributeValueResource;
use App\Models\AttributeValue;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttributeValue extends CreateRecord
{
    protected static string $resource = AttributeValueResource::class;

    protected function getActions(): array
    {
        return [
            AttributeValue::backAction(),
        ];
    }
}
