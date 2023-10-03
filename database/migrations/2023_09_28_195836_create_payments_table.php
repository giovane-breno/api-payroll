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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("full_name");
            $table->string("role");
            $table->decimal("base_salary");
            $table->decimal("bonus");
            $table->decimal("benefits");
            $table->decimal("vacation");
            $table->decimal("discounts");
            $table->decimal("gross_salary");
            $table->decimal("net_salary");
            $table->timestamps();
        });

        Schema::table('payments', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
