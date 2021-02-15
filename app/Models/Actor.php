<?php

namespace App\Models;

use App\Models\Traits\PrimaryAsUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Actor extends Model
{
    use PrimaryAsUuid;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'bio',
        'born_at'
    ];


    public function getMovies()
    {
        return $this->hasManyThrough(Movie::class, Appearance::class, 'actor_id', 'id', 'id', 'movie_id');
    }

    public function appearance()
    {
        return $this->hasMany(Appearance::class, 'actor_id', 'id');
    }


    public static function getFavoriteGenre($actorId)
    {

        $data = Appearance::where('actor_id', $actorId)
            ->leftJoin('movies', 'movies.id', 'movie_id')
            ->leftJoin('genres', 'genres.id', 'genre_id')
            ->groupBy('genres.name')
            ->select(DB::raw('count(genres.name) as count, genres.name'))
            ->orderBy('count', 'desc')
            ->limit(1)
            ->get()
            ->toArray();

        $data['genre'] = $data;
        unset($data[0]);

        return $data;
    }

}
