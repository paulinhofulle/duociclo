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
        Schema::create('tbloja', function (Blueprint $table) {
            $table->id('lojcodigo');
            $table->string('lojnome', 255);
            $table->string('lojcnpj', 14)->unique();
            $table->integer('lojnumeroendereco');
            $table->string('lojtelefone', 11);
            $table->string('lojemail', 255)->unique();
            $table->string('lojcep', 8);
            $table->string('lojcomplementoendereco', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbloja');
    }
};
