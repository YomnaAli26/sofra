<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('address');
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->text('notes');
            $table->decimal('commission');
            $table->decimal('price');
            $table->decimal('delivery_fee');
            $table->decimal('total_amount');
            $table->decimal('net');
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('orders');

    }
};
