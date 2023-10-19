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
        Schema::create('tbaluguel', function (Blueprint $table) {
            $table->id('alucodigo');
            $table->date('aludatainicio');
            $table->date('aludatatermino');
            $table->integer('alusituacao'); // 1- em andamento 2- finalizado
            $table->timestamps();

            //relacionamentos
            $table->unsignedBigInteger('usucodigo');
            $table->foreign('usucodigo')->references('id')->on('users');

            $table->unsignedBigInteger('veicodigo');
            $table->foreign('veicodigo')->references('veicodigo')->on('tbveiculo');

            $table->unsignedBigInteger('placodigo');
            $table->foreign('placodigo')->references('placodigo')->on('tbplano');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbaluguel');
    }
};
