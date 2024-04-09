<?php

namespace App\Models;

use App\Enums\GenderEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
            Section::make()->schema([
                Select::make('team_id')
                    ->relationship('team', 'name')
                    ->required(),
                Select::make('activity_id')
                    ->relationship('activity', 'name')
                    ->required(),
                Select::make('gender')
                    ->required()
                    ->options(GenderEnum::class),
                TextInput::make('minimum_age')
                    ->required()
                    ->minValue(0)
                    ->maxLength(255),
                TextInput::make('maximum_age')
                    ->required()
                    ->minValue(0)
                    ->maxLength(255),
                TextInput::make('price')
                    ->required()
                    ->minValue(0)
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
        return $this->belongsTo(Team::class);
    }
}
