<?php

namespace App\Filament\Resources\TimingResource\Pages;

use App\Filament\Resources\TimingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimings extends ListRecords
{
    protected static string $resource = TimingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
