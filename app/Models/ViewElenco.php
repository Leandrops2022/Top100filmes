<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewElenco extends Model
{
    use HasFactory;

    protected $table = 'viewElenco';

    protected $fillable = [
        'id_filme',
        'id_ator',
        'slug',
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
