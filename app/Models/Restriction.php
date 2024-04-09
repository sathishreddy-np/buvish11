<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Restriction extends Model
{
    use HasFactory;

    protected $casts = [
        'allowed_genders' => 'array',
    ];

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.restrictions.index', Filament::getTenant()));
    }

    public static function getForm(): array
    {
        return [
            Section::make('Pesonal Details')->schema([
            ])->columnSpanFull()->columns(2),
        ];
    }


    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

}
