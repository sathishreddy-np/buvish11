<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Limit extends Model
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                Select::make('company_id')
                    ->relationship('company', 'name', modifyQueryUsing:fn (Builder $query) => $query->where('id', Filament::getTenant()->company_id))
                    ->required(),
                TextInput::make('model')
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
            ->url(route('filament.admin.resources.limits.index', Filament::getTenant()));
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
