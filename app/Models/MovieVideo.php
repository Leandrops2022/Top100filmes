<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieVideo extends Model
{
    use HasFactory;

    protected $table = 'movie_videos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'movie_id',
        'iso_639_1',
        'iso_3166_1',
        'name',
        'key',
        'site',
        'size',
        'type',
        'official',
        'embeded',
        'published_at',
    ];
}
