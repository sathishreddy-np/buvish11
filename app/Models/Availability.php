<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Availability extends Model
{
    use HasFactory;

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.availabilities.index', Filament::getTenant()));
    }

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                Select::make('activity_id')
                    ->relationship('activity', 'name')
                    ->required(),
                TextInput::make('day')
                    ->required()
                    ->maxLength(255),
            ])->columnSpanFull()->columns(2),
        ];
    }


    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function timings(): BelongsTo
    {
        return $this->belongsTo(Timing::class);
    }

}
