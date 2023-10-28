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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255); // First name (required)
            $table->string('last_name', 255); // Last name (required)
            $table->unsignedBigInteger('company_id'); // Company (foreign key)
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('email', 255)->nullable(); // Email
            $table->string('phone', 20)->nullable(); // Phone
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
