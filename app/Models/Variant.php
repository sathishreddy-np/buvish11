<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

            ]),
            Repeater::make('variantGenerator')
                ->schema([
                    Select::make('attribute')
                        ->label('Attribute')
                        ->options(Attribute::pluck('name','id'))
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live(),

                    Select::make('attributeValues')
                        ->label('Attribute Value')
                        ->options(function (Get $get){
                            return AttributeValue::where('attribute_id', $get('attribute'))->pluck('name','id');
                        })
                        ->searchable()
                        ->multiple()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(
                            fn (Select $component) => $component
                                ->getContainer()
                                ->getComponent('dynamicFields')
                        ),
                ])->columnSpanFull()->columns(2),

            Grid::make(4)
                ->schema(function (Get $get) {
                    return Variant::dynamicFields($get);
                })
                ->columnSpanFull()
                ->key('dynamicFields')
                ->live(),
        ];
    }

    public static function dynamicFields($get)
    {
        $variantGenerator = collect($get('variantGenerator'))->filter(function ($item) {
            return ! empty($item['attribute']) && ! empty($item['attributeValues']);
        });

        $selectedAttributes = $variantGenerator->values()->toArray();

        $allPossibleCombinations = Variant::generateCombinations($selectedAttributes);

        $sections = [];
        $sectionIndex = 1;

        foreach ($allPossibleCombinations as $combination) {
            $fields = [];
            $fieldIndex = 1;

            $fields[] = FileUpload::make("image_$sectionIndex")
                ->label('Image')
                ->required();

            $fields[] = TextInput::make("price_$sectionIndex")
                ->label('Price')
                ->required()
                ->numeric();
            foreach ($combination as $attributeId => $valueId) {
                $fields[] = Select::make("attribute_$sectionIndex"."_$fieldIndex")
                    ->label('Attribute')
                    ->options(Attribute::where('id', $attributeId)->pluck('name', 'id'))
                    ->default($attributeId)
                    ->required();

                $fields[] = Select::make("value_$sectionIndex"."_$fieldIndex")
                    ->label('Value')
                    ->options(AttributeValue::where('id', $valueId)->pluck('name', 'id'))
                    ->default($valueId)
                    ->required();

                $fieldIndex++;
            }

            $sections[] = Section::make("Variant Combination - $sectionIndex")
                ->schema($fields)->columnSpan(2)->columns(2);

            $sectionIndex++;
        }

        return $sections;
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
