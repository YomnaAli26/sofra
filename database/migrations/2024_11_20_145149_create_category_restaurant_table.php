<?php

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
        Schema::create('category_restaurant', function (Blueprint $table) {
            $table->foreignId("restaurant_id")->constrained()->cascadeOnDelete();
            $table->foreignId("category_id")->constrained()->cascadeOnDelete();
            $table->primary(["restaurant_id", "category_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_restaurant');
    }
};
