<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_votes extends Model
{
    use HasFactory;

    protected $table = 'movie_votes';

    protected $primary = ['user_id, filme_id'];
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'filme_id',
        'nota',
        'created_at',
        'updated_at'
    ];

    public function filme()
    {
        return $this->hasMany(Filme::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
