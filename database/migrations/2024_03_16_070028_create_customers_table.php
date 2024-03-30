<?php

use App\Models\City;
use App\Models\Country;
use App\Models\State;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('country_code');
            $table->string('mobile');
            $table->string('communication_medium');
            $table->text('address');
            $table->foreignIdFor(Country::class);
            $table->foreignIdFor(State::class);
            $table->foreignIdFor(City::class);
            $table->string('postcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
