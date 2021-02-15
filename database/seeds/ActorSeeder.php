<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class ActorSeeder extends Seeder
{

    public function run()
    {

        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table('actors')->insert([
                'id' => $faker->uuid,
                'name' => $faker->name,
                'bio' => $faker->text,
                'born_at' => $faker->year('now'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

    }


}
