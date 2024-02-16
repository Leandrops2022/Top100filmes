<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    use HasFactory;

    protected $table = 'artigos';
    protected $fillable = [
        'slug',
        'id',
        'titulo',
        'subtitulo',
        'texto',
        'imagem_capa',
        'imagem_1',
        'imagem_2',
        'trailer',
        'created_at',
        'updated_at',
    ];
}
