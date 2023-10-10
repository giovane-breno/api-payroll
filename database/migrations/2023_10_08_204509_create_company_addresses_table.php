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
        Schema::create('company_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("company_id");
            $table->string('CEP');
            $table->string('street'); // RUA
            $table->string('district'); // BAIRRO
            $table->string('house_number'); // Nº DA CASA
            $table->string('complement')->nullable();
            $table->string('references')->nullable();
            $table->timestamps();
        });

        Schema::table('company_addresses', function($table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });

        DB::table('company_addresses')->insert(
            array(
                [
                    'company_id' => '1',
                    'CEP' => '12231-049',
                    'street' => 'Rua das Dores',
                    'district' => 'Jardim Paulista',
                    'house_number' => '811',
                    'complement' => 'Prédio Comercial',
                    'references' => 'Próximo ao Mercado Ipê',
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
        Schema::dropIfExists('company_addresses');
    }
};
