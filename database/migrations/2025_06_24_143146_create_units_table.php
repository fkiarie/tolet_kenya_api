<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('units', function (Blueprint $table) {
        $table->id();
        $table->foreignId('building_id')->constrained()->onDelete('cascade');
        $table->string('unit_number');
        $table->enum('unit_type', [
            'bedsitter', 'studio', '1_bedroom', '2_bedroom', 
            '3_bedroom', 'shop', 'bungalow'
        ]);
        $table->decimal('rent_amount', 10, 2);
        $table->decimal('deposit_amount', 10, 2);
        $table->text('description')->nullable();
        $table->integer('floor_number')->nullable();
        $table->boolean('is_occupied')->default(false);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        
        $table->unique(['building_id', 'unit_number']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
