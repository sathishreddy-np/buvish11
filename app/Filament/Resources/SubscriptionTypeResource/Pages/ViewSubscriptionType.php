<?php

namespace App\Filament\Resources\SubscriptionTypeResource\Pages;

use App\Filament\Resources\SubscriptionTypeResource;
use App\Models\SubscriptionType;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubscriptionType extends ViewRecord
{
    protected static string $resource = SubscriptionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            SubscriptionType::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
