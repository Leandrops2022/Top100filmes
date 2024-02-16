<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmesAssistidos extends Model
{
    use HasFactory;

    protected $table = 'filmes_assistidos';

    public function id_usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function id_filme()
    {
        return $this->belongsTo(Filme::class);
    }
}
