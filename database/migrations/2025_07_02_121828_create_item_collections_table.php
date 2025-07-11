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
        Schema::create('item_collections', function (Blueprint $table) {
            $table->foreignId('explorer_id')
                    ->constrained('explorers', 'id');
            $table->foreignId('item_id')
                    ->constrained('items', 'id');
            $table->integer('quantity');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_collections');
    }
};
