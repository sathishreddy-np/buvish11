<?php

use App\Models\Customer;
use App\Models\Invoice;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Invoice::class)->constrained()->cascadeOnDelete();
            $table->string('currency');
            $table->integer('amount_paid');
            $table->string('payment_gateway');
            $table->integer('transaction_reference');
            $table->string('transaction_mode');
            $table->date('transaction_date');
            $table->json('transaction_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
