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
        Schema::create('time_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->timestamp("entry_time");
            $table->timestamp("entry_lunch");
            $table->timestamp("exit_lunch");
            $table->timestamp("exit_time");
            $table->time("total_time");
            $table->timestamps();

        });

        Schema::table('time_record', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_record');
    }
};