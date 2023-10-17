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
        return;
        Schema::create('tbusuario', function (Blueprint $table) {
            $table->id('usucodigo');
            $table->string('usunome');
            $table->string('usucpf', 11)->unique();
            $table->integer('usutipo'); // 1-admin 2-lojista 3-cliente
            $table->date('usudatanascimento');
            $table->integer('usunumeroendereco');
            $table->string('password');
            $table->string('usutelefone', 11);
            $table->string('usuemail', 255)->nullable();
            $table->string('usucep', 8);
            $table->string('usucomplementoendereco', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();

            // relacionamento
            $table->unsignedBigInteger('lojcodigo')->nullable();
            $table->foreign('lojcodigo')->references('lojcodigo')->on('tbloja')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbusuario');
    }
};
