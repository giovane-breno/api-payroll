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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('CEP');
            $table->string('street'); // RUA
            $table->string('district'); // BAIRRO
            $table->string('house_number'); // Nº DA CASA
            $table->string('complement')->nullable();
            $table->string('references')->nullable();
            $table->timestamps();
        });

        Schema::table('addresses', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};