<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rules\Unique;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('name')
                    ->label('Role Name')
                    ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, Get $get) {
                        return $rule->where('company_id', $get('company_id'))
                            ->where('guard_name', 'web');
                    })
                    ->required()
                    ->maxLength(255),
                CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->searchable()
                    ->required()
                    ->bulkToggleable()
                    ->selectAllAction(
                        fn (ActionsAction $action) => $action->label('Select all permissions'),
                    )
                    ->searchPrompt('Search for permissions')
                    ->noSearchResultsMessage('No results found.')
                    ->columnSpanFull()->columns(4),
                Hidden::make('guard_name')
                    ->required()
                    ->default('web'),
            ]),
        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.roles.index', Filament::getTenant()));
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
