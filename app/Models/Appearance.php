<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appearance extends Model
{
    protected $fillable = [
        'movie_id',
        'actor_id'
    ];

}
