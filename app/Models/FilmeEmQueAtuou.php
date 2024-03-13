<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmeEmQueAtuou extends Model
{
    use HasFactory;

    protected $table = 'filmes_em_que_atuou';

    protected $fillable = [
        "id_ator",
        "titulo_portugues",
        "poster_mobile",
        "poster_fallback",
        "id_filme",
        "slug",
        "ano_lancamento",
        "personagem",
        "nota"
    ];
}
