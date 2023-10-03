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
        Schema::create('benefit_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("bonus");
            $table->timestamps();
        });

        DB::table('benefit_types')->insert(
            array(
                [
                    'name' => 'Vale-Transporte',
                    'bonus' => 213.80,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Vale-Alimentação',
                    'bonus' => 670.00,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefit_types');
    }
};
