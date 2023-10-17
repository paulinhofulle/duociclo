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
        Schema::create('tbmarca', function (Blueprint $table) {
            $table->id('marcodigo');
            $table->string('marnome', 255);
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
        Schema::dropIfExists('tbmarca');
    }
};
