<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'categories_id',
        'description',
        'pic_path',
        'length',
        'release_date',
        'director_id'
    ];
}
