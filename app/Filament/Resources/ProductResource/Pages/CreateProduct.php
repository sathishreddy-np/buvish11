<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\Variant;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getActions(): array
    {
        return [
            Product::backAction(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {

            $new_data = [
                'team_id' => Filament::getTenant()->id,
                'name' => $data['name'],
                'brand_id' => $data['brand_id'],
                'description' => $data['description'],
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'hsn_code' => $data['hsn_code'],
                'sku_code' => $data['sku_code'],
                'barcode' => $data['barcode'],
                'is_taxable' => $data['is_taxable'],
                'is_vat_applied' => $data['is_vat_applied'],
                'is_coupon_applicable' => $data['is_coupon_applicable'],
                'is_digital' => $data['is_digital'],
                'digital_product_file' => $data['digital_product_file'] ?? null,
                'source' => $data
            ];

            $product_id = Product::create($new_data)->id;
            $data['product_id'] = $product_id;

            return $data;
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Something went wrong.')
                ->danger()
                ->send();
        }
    }

    protected function handleRecordCreation(array $data): Model
    {
        $product_id = $data['product_id'];

        try {
            DB::transaction(function () use ($data) {
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

                foreach ($variants as $variant) {
                    $variant_id = Variant::create(
                        [
                            'team_id' => Filament::getTenant()->id,
                            'product_id' => $variant['product_id'],
                            'image' => $variant['image'],
                            'price' => $variant['price'],
                        ]
                    )->id;

                    foreach ($variant['variants'] as $attribute_id => $value_id) {
                        DB::table('attribute_variant')->insert([
                            'variant_id' => $variant_id,
                            'attribute_id' => $attribute_id,
                            'attribute_value_id' => $value_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            });

            return Product::find($product_id);
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Something went wrong.')
                ->danger()
                ->send();
        }
    }
}
