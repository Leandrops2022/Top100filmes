<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elenco extends Model
{
    use HasFactory;

    protected $table = 'elenco_filmes';

    protected $fillable = [
        'id_filme',
        'id_ator',
        'personagem',
        'ordem_importancia'
    ];

    public function filme()
    {
        return $this->hasMany(Filme::class);
    }

    public function ator()
    {
        return $this->hasMany(Ator::class);
    }
}
