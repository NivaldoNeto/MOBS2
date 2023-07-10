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
        Schema::table('produtos', function (Blueprint $table)) {

            DB:: table('fornecedores')->insert([
                'nome' => 'Forncedor Padrão SG',
                'site' => 'fornecedorpadraosg.com.br',
                'uf' => 'SP',
                'email' => 'contato@fornecedorpadraosg.com.br'
            ]);

            $table->unsignedBigInteger('fornecedor_id')->after('id');
            $table->foreign('fornecedor_id')->references(id)->on('fornecedores');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
