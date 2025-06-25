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
    Schema::create('tenants', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('unit_id')->nullable()->constrained()->onDelete('set null');
        $table->string('id_number')->nullable();
        $table->string('emergency_contact_name')->nullable();
        $table->string('emergency_contact_phone')->nullable();
        $table->date('lease_start_date')->nullable();
        $table->date('lease_end_date')->nullable();
        $table->decimal('monthly_rent', 10, 2)->nullable();
        $table->decimal('deposit_paid', 10, 2)->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
