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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("incident_reason"); // Atraso, vandalismo e tals 
            $table->decimal("discounted_amount");
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('incidents', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident');
    }
};