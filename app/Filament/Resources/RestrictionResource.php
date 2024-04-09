<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestrictionResource\Pages;
use App\Filament\Resources\RestrictionResource\RelationManagers;
use App\Models\Restriction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RestrictionResource extends Resource
{
    protected static ?string $model = Restriction::class;

    protected static ?string $navigationIcon = 'heroicon-m-viewfinder-circle';

    protected static ?string $navigationGroup = 'Sport';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Restriction::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->columns([
                Tables\Columns\TextColumn::make('team.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('activity.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('minimum_age')
                    ->searchable(),
                Tables\Columns\TextColumn::make('maximum_age')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
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
            'index' => Pages\ListRestrictions::route('/'),
            'create' => Pages\CreateRestriction::route('/create'),
            'view' => Pages\ViewRestriction::route('/{record}'),
            'edit' => Pages\EditRestriction::route('/{record}/edit'),
        ];
    }
}
