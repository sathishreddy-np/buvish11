<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    protected function name(): CastsAttribute
    {
        return CastsAttribute::make(
            get: fn (string $value) => ucwords($value),
        );
    }

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TagsInput::make('value')
                    ->required(),
            ]),
        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.attributes.index', Filament::getTenant()));
    }

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(Variant::class, 'attribute_variant')->withPivot('attribute_value_id')->withTimestamps();
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
