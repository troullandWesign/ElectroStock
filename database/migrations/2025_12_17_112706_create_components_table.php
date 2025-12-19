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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference')->unique();
            $table->enum('type', ['resistor', 'capacitor', 'microcontroller']);
            $table->text('description')->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->decimal('price', 10, 2);
            $table->json('specifications')->nullable();
            $table->timestamps();
            
            $table->index('type');
            $table->index('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
