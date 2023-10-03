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
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("abilities");
            $table->timestamps();
            // $table->string("level");
        });

        DB::table('admin_roles')->insert(
            array(
                [
                    'name' => 'Master',
                    'abilities' => "['*']",
                    // 'level' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Operador',
                    'abilities' => "['']",
                    // 'level' => 2,
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
        Schema::dropIfExists('admin_roles');
    }
};
