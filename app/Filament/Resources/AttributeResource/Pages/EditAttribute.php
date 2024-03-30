<?php

namespace App\Filament\Resources\AttributeResource\Pages;

use App\Filament\Resources\AttributeResource;
use App\Models\Attribute;
use App\Models\Variant;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttribute extends EditRecord
{
    protected static string $resource = AttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Attribute::backAction(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
