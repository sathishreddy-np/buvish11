<?php

namespace App\Filament\Resources\PromotionResource\Pages;

use App\Filament\Resources\PromotionResource;
use App\Models\Promotion;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ViewRecord;

class ViewPromotion extends ViewRecord
{
    protected static string $resource = PromotionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Promotion::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
