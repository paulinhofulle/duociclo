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
        Schema::create('tbmanutencao', function (Blueprint $table) {
            $table->id('mancodigo');
            $table->double('manvalor', 10, 2);
            $table->integer('mansituacao'); // 1- em andamento 2- finalizado
            $table->date('mandatainicio');
            $table->date('mandatatermino')->nullable();
            $table->text('manobservacao')->nullable();
            $table->string('mandescricao');
            $table->timestamps();

            //relacionamentos
            $table->unsignedBigInteger('veicodigo');
            $table->foreign('veicodigo')->references('veicodigo')->on('tbveiculo')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbmanutencao');
    }
};
