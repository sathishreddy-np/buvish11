<?php

namespace App\Filament\Resources\AttributeResource\Pages;

use App\Filament\Resources\AttributeResource;
use App\Models\Attribute;
use Filament\Resources\Pages\CreateRecord;

class CreateAttribute extends CreateRecord
{
    protected static string $resource = AttributeResource::class;

    protected function getActions(): array
    {
        return [
            Attribute::backAction(),
        ];
    }

}
