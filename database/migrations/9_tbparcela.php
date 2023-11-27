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
    Schema::create('tbparcela', function (Blueprint $table) { // Vamos manter um id autoincrementável como chave primária
        $table->integer('parsequencia');
        $table->integer('parsituacao');
        $table->date('pardatavencimento');
        $table->double('parvalor', 10, 2);
        $table->timestamps();

        $table->unsignedBigInteger('alucodigo');
        $table->foreign('alucodigo')->references('alucodigo')->on('tbaluguel');

        // Adicionando a chave composta
        $table->primary(['parsequencia', 'alucodigo']);
        $table->unique(['parsequencia', 'alucodigo']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbparcela');
    }
};
