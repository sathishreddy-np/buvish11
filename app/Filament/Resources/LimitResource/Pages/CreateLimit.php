<?php

namespace App\Filament\Resources\LimitResource\Pages;

use App\Filament\Resources\LimitResource;
use App\Models\Limit;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLimit extends CreateRecord
{
    protected static string $resource = LimitResource::class;

    protected function getActions(): array
    {
        return [
            Limit::backAction(),
        ];
    }
}
