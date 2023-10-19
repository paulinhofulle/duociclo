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
        Schema::create('tbveiculo', function (Blueprint $table) {
            $table->id('veicodigo');
            $table->integer('veiano');
            $table->integer('veiquilometragem');
            $table->integer('veisituacao'); // 1- disponível 2- em uso 3- em manutencao
            $table->string('veiplaca', 10)->unique();
            $table->string('veicor');
            $table->string('veidescricao');
            $table->string('veiimagem')->nullable();
            $table->timestamps();

            // relacionamentos
            $table->unsignedBigInteger('lojcodigo');
            $table->foreign('lojcodigo')->references('lojcodigo')->on('tbloja')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('marcodigo');
            $table->foreign('marcodigo')->references('marcodigo')->on('tbmarca')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbveiculo');
    }
};
