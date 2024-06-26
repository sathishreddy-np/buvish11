<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                FileUpload::make('image')
                ->label('Logo')
                ->image()
                ->imageEditor()
                ->imageCropAspectRatio('4:4')
                ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]),
        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.companies.index', Filament::getTenant()));
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function limits(): HasMany
    {
        return $this->hasMany(Limit::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

}
