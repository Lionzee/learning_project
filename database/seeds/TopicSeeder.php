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
            'user_id' => '2',
            'title' => "Game Design 101",
            'description' => "Basic Game Design",
            'is_public' => true,
        ]);

        $topic = Topic::create([
            'user_id' => '3',
            'title' => "Marketing",
            'description' => "Marketing Knowledge",
            'is_public' => true,
        ]);

        for($i=0;$i<10;$i++){
            $topic = Topic::create([
                'user_id' => User::all()->where('role_id','2')->random()->id,
                'title' => $faker->words($nb = 2, $asText = true),
                'description' => $faker->sentence($nbWords = 7, $variableNbWords = true),
                'is_public' => true,
            ]);
        }
    }
}
