<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectMoviesActors extends Model
{
    public $table = "movies_actors";
    protected $fillable=[
        'movie_id',
        'actor_id'
    ];
}
