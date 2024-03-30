<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    public function getConcatenatedNameCurrencyCodeSymbolAttribute()
    {
        return $this->name.' - '.$this->code.' - '.$this->symbol;
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.currencies.index', Filament::getTenant()));
    }
}
