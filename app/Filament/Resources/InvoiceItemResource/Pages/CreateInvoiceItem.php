<?php

namespace App\Filament\Resources\InvoiceItemResource\Pages;

use App\Filament\Resources\InvoiceItemResource;
use App\Models\InvoiceItem;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoiceItem extends CreateRecord
{
    protected static string $resource = InvoiceItemResource::class;

    protected function getActions(): array
    {
        return [
            InvoiceItem::backAction(),
        ];
    }

}
