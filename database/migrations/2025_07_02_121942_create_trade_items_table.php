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
        Schema::create('trade_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trade_id')
                    ->constrained('trades', 'id');
            $table->foreignId('item_id_trader')
                    ->constrained('items', 'id');
            $table->foreignId('item_id_buyer')
                    ->constrained('items', 'id');
            $table->integer('quantity_trader');
            $table->integer('quantity_buyer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_items');
    }
};
