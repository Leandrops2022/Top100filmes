<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ator extends Model
{
    use HasFactory;

    protected $table = 'atores';
    protected $fillable = [
        'imdb_id',
        'nome',
        'biografia',
        'nascimento',
        'morte',
        'genero_sexo',
        'local_nascimento',
        'popularidade',
        'poster',
        'imagem',
        'imagem_fallback'
    ];

    public function filme()
    {
        return $this->belongsTo(Elenco::class);
    }
}
