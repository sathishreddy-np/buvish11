<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\Variant;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Product::backAction(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data['source'];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $product_id = $record->id;

        $categories = DB::table('category_product')->where('product_id',$product_id)->pluck('category_id');
            $promotions = DB::table('product_promotion')->where('product_id',$product_id)->pluck('promotion_id');
            $tags = DB::table('product_tag')->where('product_id',$product_id)->pluck('tag_id');
            $data['product_id'] = $product_id;
            $data['categories'] = $categories;
            $data['promotions'] = $promotions;
            $data['tags'] = $tags;

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

        $record->update($new_data);


        try {
            DB::transaction(function () use ($data, $record) {
                $variants = [];
                $variantIndex = 1;

                // Loop through each set of attributes
                while (isset($data['attribute_' . $variantIndex . '_1'])) {
                    $variant = [];
                    $variant['product_id'] = $record->id;

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
                $all_variant_ids = Variant::where('product_id',$record->id)->pluck('id');

                Variant::whereIn('id',$all_variant_ids)->delete();
                DB::table('attribute_variant')->whereIn('variant_id',$all_variant_ids)->delete();
                foreach ($variants as $variant) {
                    $variant_id = Variant::updateOrCreate(
                        [
                            'team_id' => Filament::getTenant()->id,
                            'product_id' => $variant['product_id'],
                            'image' => $variant['image'],
                            'price' => $variant['price'],
                        ]
                    )->id;

                    $variant_name = "";
                    foreach ($variant['variants'] as $attribute_id => $value_id) {
                        DB::table('attribute_variant')->insert([
                            'variant_id' => $variant_id,
                            'attribute_id' => $attribute_id,
                            'attribute_value_id' => $value_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $attribute = Attribute::where('id',$attribute_id)->first();
                        $value = AttributeValue::where('id',$value_id)->first();
                        if($attribute && $value){
                            $variant_name .= '( '. $attribute->name . ': ' . $value->name .' ) ';
                        }
                    }
                    DB::table('variants')->where('id',$variant_id)->update(['name' => $variant_name]);

                }
            });

            return Product::find($product_id);
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Something went wrong.')
                ->danger()
                ->send();
        }


        return $record;
    }
}
