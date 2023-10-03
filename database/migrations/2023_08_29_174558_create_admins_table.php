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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger("admin_role_id");
            $table->timestamps();
        });

        Schema::table('admins', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_role_id')->references('id')->on('admin_roles');
        });

        DB::table('admins')->insert(
            array(
                [
                    'user_id' => '1',
                    'admin_role_id' => 1, // Master
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
        Schema::dropIfExists('admins');
    }
};
