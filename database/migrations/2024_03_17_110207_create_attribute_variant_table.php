<?php

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Variant;
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
        Schema::create('attribute_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Variant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Attribute::class);
            $table->foreignIdFor(AttributeValue::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_variant');
    }
};
