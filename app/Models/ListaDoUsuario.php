<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaDoUsuario extends Model
{
    use HasFactory;

    protected $table = 'listas_do_usuario';

    protected $fillable = [
        'id',
        'id_usuario',
        'nome_da_lista',
        'created_at',
        'updated_at'
    ];

    public function id_usuario()
    {
        return $this->belongsTo(User::class);
    }
}
