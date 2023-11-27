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
        Schema::create('tbparcela', function (Blueprint $table) {
            $table->id('parsequencia');
            $table->integer('parsituacao'); //1- aberta 2- paga
            $table->date('pardatavencimento');
            $table->double('parvalor', 10, 2);
            $table->timestamps();

            $table->unsignedBigInteger('alucodigo');
            $table->foreign('alucodigo')->references('alucodigo')->on('tbaluguel')->onDelete('cascade')->onUpdate('cascade');
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
