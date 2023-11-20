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
        Schema::create('users', function (Blueprint $table) {
            //$table->id('usucodigo');
            //$table->string('usunome');
            //$table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            //$table->string('password');
            //$table->rememberToken();
            //$table->timestamps();

            $table->id();
            $table->string('usunome');
            $table->string('usucpf', 11)->unique();
            $table->integer('usutipo'); // 1-admin 2-lojista 3-cliente
            $table->date('usudatanascimento');
            $table->integer('usunumeroendereco');
            $table->string('password');
            $table->string('usutelefone', 11);
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('usucep', 8);
            $table->string('usucomplementoendereco', 255)->nullable();
            $table->string('usurua', 255);
            $table->string('usubairro', 255);
            $table->string('usucidade', 255);
            $table->string('usuestado', 2);
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
    public function down(): void{
        Schema::dropIfExists('users');
    }
};
