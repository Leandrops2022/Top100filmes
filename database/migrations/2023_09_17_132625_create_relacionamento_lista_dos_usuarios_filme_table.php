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
        Schema::create('relacionamento_lista_dos_usuarios_filme', function (Blueprint $table) {
            $table->unsignedBigInteger('id_lista');
            $table->integer('id_filme');
            $table->primary(['id_lista', 'id_filme']);
            $table->foreign('id_lista')->references('id')->on('listas_do_usuario');
            $table->foreign('id_filme')->references('id')->on('filmes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relacionamento_lista_dos_usuarios_filme');
    }
};
