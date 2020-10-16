<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $topic = Topic::create([
            'user_id' => User::all()->random()->id,
            'title' => $faker->words($nb = 2, $asText = true),
            'description' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        ]);
    }
}
