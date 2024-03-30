<?php

namespace App\Models;

use Filament\Actions\Action as ActionsAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                TextInput::make('code')
                    ->label('Coupon Code')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->hintAction(Action::make('Generate')
                        ->icon('heroicon-c-arrow-path-rounded-square')
                        ->action(function (Set $set) {
                            do {
                                $random = Str::random(15);
                            } while (Coupon::where('code', $random)->exists());
                            $set('code', $random);
                        }))
                    ->maxLength(255),
            ])->columnSpanFull()->columns(2),

            Fieldset::make('Discount')->schema([
                Select::make('type')
                    ->options([
                        'fixed_amount' => 'Fixed Amount',
                        'percentage' => 'Percentage',
                    ])
                    ->required()
                    ->preload()
                    ->searchable(),
                TextInput::make('value')
                    ->required()
                    ->numeric()
                    ->minValue(0),

            ]),
            Fieldset::make('Usage')->schema([
                TextInput::make('limit')
                    ->label('No of times can be used')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                TextInput::make('usage_count')
                    ->label('No of times already used')
                    ->required()
                    ->numeric()
                    ->minValue(0),
            ]),
            Fieldset::make('Validity')->schema([
                DateTimePicker::make('starts_at')
                    ->required()
                    ->minDate(now()),
                DateTimePicker::make('expires_at')
                    ->required(),
            ]),

        ];
    }

    public static function backAction()
    {
        return ActionsAction::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.coupons.index', Filament::getTenant()));
    }

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords(str_replace('_', ' ', $value)),
        );
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
