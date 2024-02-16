<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = "noticias";
    protected $fillable = [
        'slug',
        'id',
        'titulo',
        'subtitulo',
        'texto',
        'texto_2',
        'imagem_capa',
        'imagem_1',
        'imagem_2',
        'trailer',
        'created_at',
        'modified_at',
        'alt_capa',
        'fonte_capa',
        'alt_imagem_1',
        'fonte_imagem_1',
        'alt_imagem_2',
        'fonte_imagem_2',
        'tag',
        'imagem_carrossel_1',
        'imagem_carrossel_2',
        'imagem_carrossel_3',
        'imagem_carrossel_4',
        'imagem_carrossel_5',
        'imagem_carrossel_6',
        'imagem_carrossel_7',
        'imagem_carrossel_8',
        'imagem_carrossel_9',
        'imagem_carrossel_10',
        'fonte_imagens_carrossel',
        'alt_imagens_carrossel',
    ];
}
