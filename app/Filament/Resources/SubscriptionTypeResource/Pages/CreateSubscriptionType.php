<?php

namespace App\Filament\Resources\SubscriptionTypeResource\Pages;

use App\Filament\Resources\SubscriptionTypeResource;
use App\Models\SubscriptionType;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscriptionType extends CreateRecord
{
    protected static string $resource = SubscriptionTypeResource::class;

    protected function getActions(): array
    {
        return [
            SubscriptionType::backAction(),
        ];
    }

}
