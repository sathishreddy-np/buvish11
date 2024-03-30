<?php

namespace App\Filament\Resources\VariantResource\Pages;

use App\Filament\Resources\VariantResource;
use App\Models\Variant;
use Filament\Resources\Pages\CreateRecord;
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $variants = [];
        $variantIndex = 1;

        // Loop through each set of attributes
        while (isset($data['attribute_' . $variantIndex . '_1'])) {
            $variant = [];
            $variant['product_id'] = $data['product_id'];

            // Loop through attributes for this variant
            $attributeIndex = 1;
            while (isset($data['attribute_' . $variantIndex . '_' . $attributeIndex])) {
                $attributeKey = 'attribute_' . $variantIndex . '_' . $attributeIndex;
                $valueKey = 'value_' . $variantIndex . '_' . $attributeIndex;
                $variant['variants'][$data[$attributeKey]] = $data[$valueKey];
                $attributeIndex++;
            }

            // Add image and price for this variant
            $variant['image'] = $data['image_' . $variantIndex];
            $variant['price'] = $data['price_' . $variantIndex];

            // Add this variant to the variants array
            $variants[] = $variant;
            $variantIndex++;
        }

        // Log the variants array
        Log::info($variants);

        return $variants;
    }
    }
