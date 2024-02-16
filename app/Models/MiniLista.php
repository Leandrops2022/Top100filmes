<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiniLista extends Model
{
    use HasFactory;

    protected $table = 'minilista';

    protected $fillable = [
        'slug',
        'imagem',
        'alt_imagem',
        'fonte_imagem',
        'titulo',
        'subtitulo',
        'texto',
        'filmes_ids'
    ];
}
