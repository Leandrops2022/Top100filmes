<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $table = 'filmes';

    protected $fillable = [
        'titulo_portugues',
        'resumo_portugues',
        'duracao',
        'ano_lancamento',
        'genero_1',
        'poster',
        'nota',
        'imdb_id',
        'tmdb_id',
        'tagline',
        'poster_mobile',
        'quantidade_de_votos',
        'arrecadacao',
        'genero_2',
        'genero_3',
        'diretor',
        'poster_fallback',
        'data_lancamento'
    ];

    public function movie_vote()
    {
        return $this->belongsTo(Movie_votes::class);
    }

    public function elenco()
    {
        return $this->belongsTo(Elenco::class);
    }
}
