<?php

namespace App\Filament\Resources\AttributeValueResource\Pages;

use App\Filament\Resources\AttributeValueResource;
use App\Models\AttributeValue;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttributeValue extends EditRecord
{
    protected static string $resource = AttributeValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            AttributeValue::backAction(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
