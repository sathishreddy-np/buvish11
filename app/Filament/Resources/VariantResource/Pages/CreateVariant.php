<?php

namespace App\Filament\Resources\VariantResource\Pages;

use App\Filament\Resources\VariantResource;
use App\Models\Variant;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateVariant extends CreateRecord
{
    protected static string $resource = VariantResource::class;

    protected function getActions(): array
    {
        return [
            Variant::backAction(),
        ];
    }

    protected function handleRecordCreation(array $data): Model
{
            $variants = [];
        $variantIndex = 1;

        // Loop through each set of attributes
        while (isset($data['attribute_'.$variantIndex.'_1'])) {
            $variant = [];
            $variant['product_id'] = $data['product_id'];

            // Loop through attributes for this variant
            $attributeIndex = 1;
            while (isset($data['attribute_'.$variantIndex.'_'.$attributeIndex])) {
                $attributeKey = 'attribute_'.$variantIndex.'_'.$attributeIndex;
                $valueKey = 'value_'.$variantIndex.'_'.$attributeIndex;
                $variant['variants'][$data[$attributeKey]] = $data[$valueKey];
                $attributeIndex++;
            }

            // Add image and price for this variant
            $variant['image'] = $data['image_'.$variantIndex];
            $variant['price'] = $data['price_'.$variantIndex];

            // Add this variant to the variants array
            $variants[] = $variant;
            $variantIndex++;
        }

        // Log the variants array
        Log::info($variants);
        foreach($variants as $variant){
            $variant_id = Variant::create(
                [
                    'team_id' => Filament::getTenant()->id,
                    'product_id' => $variant['product_id'],
                    'image' => $variant['image'],
                    'price' => $variant['price']
                ]
            )->id;

            foreach($variant['variants'] as $attribute_id => $value_id){
                DB::table('attribute_variant')->insert([
                    'variant_id' => $variant_id,
                    'attribute_id' => $attribute_id,
                    'attribute_value_id' => $value_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

        }

    return static::getModel()::find($variant_id);
}

}
