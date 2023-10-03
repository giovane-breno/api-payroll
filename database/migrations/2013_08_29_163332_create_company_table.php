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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("corporate_name"); //razao social
            $table->string("legal_nature"); // natureza juridica
            $table->string("CNPJ")->unique();
            $table->string("CNAE")->unique();
            $table->string("town_registration"); // inscrição municipal
            $table->string("state_registration"); // inscrição estadual
            $table->timestamps();
        });

        DB::table('company')->insert(
            array(
                [
                    'name' => 'Empresa Fictícia',
                    'corporate_name' => 'Ficticia',
                    'legal_nature' => 'Testes',
                    'CNPJ' => '12.345.678/9101-12',
                    'CNAE' => '1234-5/67',
                    'town_registration' => 'SJC',
                    'state_registration' => 'SP',
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
        Schema::dropIfExists('company');
    }
};
