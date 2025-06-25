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
    Schema::create('buildings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('landlord_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->text('address');
        $table->string('city');
        $table->string('county');
        $table->text('description')->nullable();
        $table->integer('total_units')->default(0);
        $table->decimal('latitude', 10, 8)->nullable();
        $table->decimal('longitude', 11, 8)->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
