<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\CheckboxList;
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
        $all_models = array_slice(array_map(fn ($value) => str_replace('.php', '', $value), scandir(app_path('Models'))), 2);
        $exclude_models = [
            'City',
            'State',
            'Country',
            'Timezone',
            'Currency',
            'Language',
            'Limit', // Super Admin only have access
        ];
        $models = array_diff($all_models, $exclude_models);
        $options = array_combine($models, $models);
        return [
            Section::make()->schema([
                Select::make('company_id')
                    ->relationship('company', 'name', modifyQueryUsing: fn (Builder $query) => $query->where('id', Filament::getTenant()->company_id))
                    ->required()
                    ->searchable()
                    ->preload(),
                CheckboxList::make('model')
                    ->options($options)
                    ->searchable()
                    ->columns(4),
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
