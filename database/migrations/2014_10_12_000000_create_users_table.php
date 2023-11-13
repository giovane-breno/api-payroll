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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('CPF')->unique();
            $table->string('CTPS')->unique();
            $table->string('PIS')->unique();
            $table->string('gender');
            $table->date('born_at');
            $table->string('marital_status'); //estado civil
            $table->string('education_level'); // grau de instrução
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('role_id'); // Cargo Ex. Analista de T.I
            $table->unsignedBigInteger('division_id'); // Divisao Ex. Setor de Informática
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function ($table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('division_id')->references('id')->on('divisions');
        });

        DB::table('users')->insert(
            array(
                [
                    'full_name' => "Administrator",
                    'email' => "admin@admin.com",
                    'username' => "admin",
                    'password' => Hash::make('admin'),
                    // admin
                    'CPF' => "123.456.789-10",
                    'CTPS' => "1234567-8910",
                    'PIS' => "123.45678.91-0",
                    'gender' => "Masculino",
                    'born_at' => now(),
                    'marital_status' => "Solteiro",
                    'education_level' => "Superior Completo",
                    'company_id' => 1,
                    'role_id' => 1,
                    'division_id' => 1,
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
        Schema::dropIfExists('users');
    }
};