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
        Schema::create('movie_votes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->integer('filme_id');
            $table->unsignedInteger('nota');
            $table->primary(['user_id', 'filme_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('filme_id')->references('id')->on('filmes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_votes');
    }
};
