<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LimitResource\Pages;
use App\Filament\Resources\LimitResource\RelationManagers;
use App\Models\Limit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LimitResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = Limit::class;

    protected static ?string $navigationIcon = 'heroicon-m-cube-transparent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Limit::getForm()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->columns([
                Tables\Columns\TextColumn::make('company.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model')
                    ->label('Access To')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions(
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions')
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLimits::route('/'),
            'create' => Pages\CreateLimit::route('/create'),
            'view' => Pages\ViewLimit::route('/{record}'),
            'edit' => Pages\EditLimit::route('/{record}/edit'),
        ];
    }
}
