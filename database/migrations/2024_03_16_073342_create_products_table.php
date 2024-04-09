<?php

use App\Models\Brand;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->foreignIdFor(Brand::class)->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('hsn_code')->nullable();
            $table->string('sku_code')->nullable();
            $table->string('barcode')->nullable();
            $table->boolean('is_taxable')->default(false);
            $table->boolean('is_vat_applied')->default(false);
            $table->boolean('is_coupon_applicable')->default(false);
            $table->boolean('is_digital')->default(false);
            $table->text('digital_product_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
