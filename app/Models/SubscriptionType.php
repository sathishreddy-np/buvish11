<?php

namespace App\Models;

use App\Enums\DayEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionType extends Model
{
    use HasFactory;

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.subscription-types.index', Filament::getTenant()));
    }

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                Select::make('activity')
                ->relationship('activity','name')
                ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                CheckboxList::make('days_allowed')
                    ->required()
                    ->options(DayEnum::class)->columnSpanFull()->columns(7),
                TextInput::make('no_of_days_valid')
                    ->required()
                    ->numeric(),
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

}
