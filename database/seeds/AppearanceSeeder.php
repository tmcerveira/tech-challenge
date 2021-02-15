<?php

use App\Models\Actor;
use App\Models\Appearance;
use App\Models\Movie;
use Illuminate\Database\Seeder;



class AppearanceSeeder extends Seeder
{

    public function run()
    {

        foreach (range(1,120) as $index) {

           Appearance::insert([
                'movie_id' => $this->getRandomMovieId(),
                'actor_id' => $this->getRandomActorId(),
            ]);
        }

    }


    private function getRandomActorId() {
        $actor = Actor::inRandomOrder()->first();
        return $actor->id;
    }


    private function getRandomMovieId() {
        $movie = Movie::inRandomOrder()->first();
        return $movie->id;
    }


}
