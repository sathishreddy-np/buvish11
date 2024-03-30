<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements FilamentUser, HasTenants
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('name')
                    ->label('User Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
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
                DateTimePicker::make('email_verified_at'),
                CheckboxList::make('teams')
                    ->label('Assign Teams')
                    ->relationship('teams', 'name')
                    ->required()
                    ->columnSpanFull()->columns(3),
                    CheckboxList::make('roles')
                    ->label('Assign Roles')
                    ->relationship('roles', 'name')
                    ->required()
                    ->columnSpanFull()->columns(3),
            ])->columnSpanFull()->columns(2),
        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.users.index', Filament::getTenant()));
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withTimestamps();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
