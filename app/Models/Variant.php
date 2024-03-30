<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class Variant extends Model
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                FileUpload::make('image')
                    ->required()
                    ->columnSpanFull(),
                Select::make('currency_id')
                    ->label('Currency')
                    ->options(Currency::all()->pluck('concatenated_name_currency_code_symbol', 'id'))
                    ->searchable()
                    ->preload(),
                TextInput::make('price')
                    ->required()
                    ->numeric(),

            ]),
            Repeater::make('variantGenerator')
                ->schema([
                    Select::make('attribute')
                        ->label('Attribute')
                        ->relationship('attributes', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live(),

                    Select::make('attributeValues')
                        ->label('Attribute Value')
                        ->relationship('attributeValues', 'name', fn (Builder $query, Get $get) => $query->where('attribute_values.attribute_id', $get('attribute')))
                        ->searchable()
                        ->multiple()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(
                            fn (Select $component) => $component
                                ->getContainer()
                                ->getComponent('dynamicFields')
                        )
                ])->columnSpanFull()->columns(2),


            Grid::make(4)
                ->schema(function (Get $get) {
                    return Variant::dynamicFields($get);
                })
                ->columnSpan(1)->columns(2)
                ->key('dynamicFields')
                ->live()
        ];
    }

    public static function dynamicFields($get)
    {
        $selected = collect($get('variantGenerator'))->filter(fn ($item) => !empty($item['attribute']) && !empty($item['attributeValues']));

        $all_attributes = $selected->values()->toArray();

        $all_possible_combinations = Variant::generateCombinations($all_attributes);


        $arrays = [];
        foreach ($all_possible_combinations as $key => $value) {

            array_push($arrays, $value);
        }
        $i = 0;
        $a = [];
        foreach ($arrays as $arr) {

            $a[] = FileUpload::make("image_$i")->required();
            $a[] = TextInput::make("price_$i")->required()->numeric();

            foreach ($arr as $key => $value) {
                $a[] = Select::make("attr_$i")
                    ->options(Attribute::where('id', $key)->pluck('name', 'id'))
                    ->default($key)
                    ->required();

                $a[] = Select::make("val_$i")
                    ->options(AttributeValue::where('id', $value)->pluck('name', 'id'))
                    ->default($value)
                    ->required();

                $i++;
            }
        }
        return $a;
    }

    public static function generateCombinations($attributes)
    {
        $combinations = [[]];

        foreach ($attributes as $attribute) {
            $attributeValues = $attribute['attributeValues'];
            $newCombinations = [];

            foreach ($combinations as $combination) {
                foreach ($attributeValues as $value) {
                    $newCombination = $combination;
                    $newCombination[$attribute['attribute']] = $value;
                    $newCombinations[] = $newCombination;
                }
            }

            $combinations = $newCombinations;
        }

        return $combinations;
    }


    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.variants.index', Filament::getTenant()));
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_variant')->withPivot('attribute_value_id')->withTimestamps();
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_variant')->withPivot('attribute_value_id')->withTimestamps();
    }
}
