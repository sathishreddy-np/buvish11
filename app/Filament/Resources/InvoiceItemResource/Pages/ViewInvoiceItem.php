<?php

namespace App\Filament\Resources\InvoiceItemResource\Pages;

use App\Filament\Resources\InvoiceItemResource;
use App\Models\InvoiceItem;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInvoiceItem extends ViewRecord
{
    protected static string $resource = InvoiceItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            InvoiceItem::backAction(),
            Actions\EditAction::make(),
        ];
    }
}
