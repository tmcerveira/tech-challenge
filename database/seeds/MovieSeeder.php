<?php

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class MovieSeeder extends Seeder
{

    public function run()
    {


        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('movies')->insert([
                'id' => Str::uuid(),
                'name' => substr($faker->sentence(2), 0, -1),
                'year' => $faker->year('now'),
                'synopsis' => $faker->text,
                'runtime' => rand(120,240),
                'released_at' => $faker->year('now'),
                'cost' => rand(10000,200000),
                'genre_id' => $this->getRandomGenreId(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }


    }


    private function getRandomGenreId() {
        $genreId = Genre::inRandomOrder()->first();
        return $genreId->id;
    }


}
