<?php

namespace App\Filament\Resources\CouponResource\Pages;

use App\Filament\Resources\CouponResource;
use App\Models\Coupon;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCoupon extends ViewRecord
{
    protected static string $resource = CouponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Coupon::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
