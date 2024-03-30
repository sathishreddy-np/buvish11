<?php

namespace App\Filament\Resources\VariantResource\Pages;

use App\Filament\Resources\VariantResource;
use App\Models\Variant;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateVariant extends CreateRecord
{
    protected static string $resource = VariantResource::class;

    protected function getActions(): array
    {
        return [
            Variant::backAction(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Log::info($data);

        return $data;
    }
}
