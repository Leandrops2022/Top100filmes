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
        Schema::create('filmes_assistidos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->integer('id_filme');
            $table->primary(['id_usuario', 'id_filme']);
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_filme')->references('id')->on('filmes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes_assistidos');
    }
};
