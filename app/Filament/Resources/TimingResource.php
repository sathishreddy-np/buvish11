<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimingResource\Pages;
use App\Filament\Resources\TimingResource\RelationManagers;
use App\Models\Availability;
use App\Models\Timing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimingResource extends Resource
{
    protected static ?string $model = Timing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sport';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Timing::getForm());
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
                Tables\Columns\TextColumn::make('availability.day')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('starts_at'),
                Tables\Columns\TextColumn::make('ends_at'),
                Tables\Columns\TextColumn::make('availability')
                    ->numeric()
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
            'index' => Pages\ListTimings::route('/'),
            'create' => Pages\CreateTiming::route('/create'),
            'view' => Pages\ViewTiming::route('/{record}'),
            'edit' => Pages\EditTiming::route('/{record}/edit'),
        ];
    }
}
