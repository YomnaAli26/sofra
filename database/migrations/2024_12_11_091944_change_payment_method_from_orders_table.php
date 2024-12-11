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
        Schema::table('orders', function (Blueprint $table) {

            $table->renameColumn('payment_method', 'payment_method_id');

            $table->unsignedBigInteger('payment_method_id')->nullable()->change();

            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

//            $table->dropForeign(['payment_method_id']);
//
//            $table->string('payment_method_id')->change();
//
//            $table->renameColumn('payment_method_id', 'payment_method');
        });
    }
};
