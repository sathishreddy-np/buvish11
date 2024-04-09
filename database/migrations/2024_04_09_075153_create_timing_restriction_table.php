<?php

use App\Models\Restriction;
use App\Models\Timing;
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
        Schema::create('timing_restriction', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Timing::class);
            $table->foreignIdFor(Restriction::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timing_restriction');
    }
};
