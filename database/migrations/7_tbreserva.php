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
        Schema::create('tbreserva', function (Blueprint $table) {
            $table->id('rescodigo');
            $table->date('resdatainicio');
            $table->date('resdatatermino');
            $table->integer('ressituacao'); // 1- pendente 2- aceita 3- recusada
            $table->timestamps();

            $table->unsignedBigInteger('usucodigo');
            $table->foreign('usucodigo')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('veicodigo');
            $table->foreign('veicodigo')->references('veicodigo')->on('tbveiculo')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('placodigo');
            $table->foreign('placodigo')->references('placodigo')->on('tbplano')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbreserva');
    }
};
