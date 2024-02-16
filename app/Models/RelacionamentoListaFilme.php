<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelacionamentoListaFilme extends Model
{
    use HasFactory;

    protected $table = 'relacionamento_lista_dos_usuarios_filme';

    protected $fillable = [
        'id_lista',
        'id_filme',
        'created_at',
        'updated_at',
    ];

    public function id_lista()
    {
        $this->belongsTo(ListaDoUsuario::class);
    }

    public function id_filme()
    {
        return $this->belongsTo(Filme::class);
    }
}
