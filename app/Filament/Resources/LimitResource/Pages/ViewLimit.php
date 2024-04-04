<?php

namespace App\Filament\Resources\LimitResource\Pages;

use App\Filament\Resources\LimitResource;
use App\Models\Limit;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLimit extends ViewRecord
{
    protected static string $resource = LimitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Limit::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
