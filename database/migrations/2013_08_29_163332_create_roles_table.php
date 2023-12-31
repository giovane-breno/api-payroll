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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("base_salary");
            $table->timestamps();
        });

        DB::table('roles')->insert(
            array(
                [
                    'name' => 'Desenvolvedor',
                    'base_salary' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Sem Atribuição',
                    'base_salary' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
