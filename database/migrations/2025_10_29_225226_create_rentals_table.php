<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id('rental_id');

            // Foreign key customer
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');

            // Foreign key item
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');

            $table->date('rent_date')->default(DB::raw('CURRENT_DATE'));
            $table->date('return_date')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('status', 20)->default('rented');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
