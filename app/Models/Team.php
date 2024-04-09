<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Team extends Model
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            Section::make('Team Information')->schema([
                TextInput::make('name')
                    ->label('Team Name')
                    ->required()
                    ->maxLength(255),
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required()
                    ->searchable(),
                TextInput::make('email')
                    ->email()
                    ->required()
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
            ])->columnSpanFull()->columns(2),

            Section::make('Location')->schema([
                Textarea::make('address')
                    ->required()
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
                    ->required()
                    ->maxLength(255),
                Select::make('timezone_id')
                    ->label('Timezone')
                    ->options(Timezone::all()->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('currency_id')
                    ->label('Timezone')
                    ->options(Currency::all()->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->required(),

            ])->columnSpanFull()->columns(2),
        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.teams.tags.index', Filament::getTenant()));
    }

    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
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

    public function varients(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }

    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }

    public function timings(): HasMany
    {
        return $this->hasMany(Timing::class);
    }


    public function restrictions(): HasMany
    {
        return $this->hasMany(Restriction::class);
    }

}
