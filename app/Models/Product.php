<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'source' => 'array',
    ];

    public static function getForm(): array
    {
        return [
            Section::make('Product Information')->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ])->columnSpan(3)->columns(2),
            Section::make('SEO')->schema([
                TextInput::make('meta_title')
                    ->label('Meta Title')
                    ->maxLength(255),
                Textarea::make('meta_description')
                    ->label('Meta Description')
                    ->maxLength(255),
            ])->columnSpan(3)->columns(2),
            Section::make('Classification')->schema([
                Select::make('categories')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->required()
                    ->columnSpanFull(),
                Select::make('tags')
                    ->relationship('tags', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('hsn_code')
                    ->label('HSN Code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sku_code')
                    ->label('SKU Code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('barcode')
                    ->label('Barcode')
                    ->required()
                    ->maxLength(255),
            ])->columnSpan(3)->columns(3),
            Section::make('Taxes')
                ->description('Calculted based on HSN Code')
                ->schema([
                    Toggle::make('is_taxable')
                        ->label('Is Taxable')
                        ->onColor('success')
                        ->inline(true),
                    Toggle::make('is_vat_applied')
                        ->label('Is VAT Applied')
                        ->onColor('success')
                        ->inline(true),
                    Toggle::make('is_coupon_applicable')
                        ->label('Is Coupon applicable')
                        ->onColor('success')
                        ->inline(true),
                ])->columnSpan(3)->columns(3),
            Section::make('Promotions')
                ->description('Listed under promotions in your website.')
                ->schema([
                    Select::make('promotions')
                        ->relationship('promotions', 'name')
                        ->searchable()
                        ->preload()
                        ->multiple()
                        ->required(),
                ])->columnSpan(3),
            Section::make('Product Type')
                ->description('Digital products can only be downloaded.')
                ->schema([
                    Toggle::make('is_digital')
                        ->onColor('success')
                        ->inline(true)
                        ->live()
                        ->required(),
                    FileUpload::make('digital_product_file')
                        ->visible(function (Get $get) {
                            if ($get('is_digital')) {
                                return true;
                            }
                        })
                        ->required(function (Get $get) {
                            if ($get('is_digital')) {
                                return true;
                            }
                        }),
                ])->columnSpan(3),

            Repeater::make('variantGenerator')
                ->schema([
                    Select::make('attribute')
                        ->label('Attribute')
                        ->options(Attribute::pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live(),

                    Select::make('attributeValues')
                        ->label('Attribute Value')
                        ->options(function (Get $get) {
                            return AttributeValue::where('attribute_id', $get('attribute'))->pluck('name', 'id');
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
                ->image()
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
            ->url(route('filament.admin.resources.products.index', Filament::getTenant()));
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class)->withTimestamps();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
