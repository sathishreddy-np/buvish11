<?php

namespace App\Models;

use App\Enums\CommunicationMediumEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Customer extends Model
{
    use HasFactory;

    protected $casts = [
        'communication_medium' => 'array',
    ];

    public static function getForm(): array
    {
        return [
            Section::make('Pesonal Details')->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Select::make('country_code')
                    ->label('Country Code')
                    ->options(Country::all()->pluck('concatenated_name_phone_code', 'phone_code'))
                    ->preload()
                    ->searchable(),
                TextInput::make('mobile')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxLength(255),
            ])->columnSpanFull()->columns(2)->collapsible(),
            Fieldset::make('Customer Opted Communications')->schema([
                CheckboxList::make('communication_medium')
                    ->options(CommunicationMediumEnum::class)
                    ->hiddenLabel()
                    ->required()
                    ->columnSpanFull()
                    ->columns(3),
            ]),
            Section::make('Location')->schema([
                Textarea::make('address')
                    ->columnSpanFull(),
                Select::make('country_id')
                    ->label('Country')
                    ->options(Country::query()->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('city_id', ''))
                    ->live(),
                Select::make('state_id')
                    ->label('State')
                    ->options(fn (Get $get): Collection => State::query()
                        ->where('country_id', $get('country_id'))
                        ->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->live(),
                Select::make('city_id')
                    ->label('City')
                    ->options(fn (Get $get): Collection => City::query()
                        ->where('state_id', $get('state_id'))
                        ->pluck('name', 'id'))
                    ->preload()
                    ->searchable(),
                TextInput::make('postcode')
                    ->maxLength(255),
            ])->columnSpanFull()->columns(2)->collapsible(),
        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.customers.index', Filament::getTenant()));
    }


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
