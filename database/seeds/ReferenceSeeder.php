<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $note = Note::create([
            'topic_id' => '1',
            'title' => "Brainstorming",
            'description' => "Get the Imagination",
            'url' => "brainstormingtips.com",
            'is_public' => true,
        ]);

        $note = Note::create([
            'topic_id' => '1',
            'title' => "Prototyping",
            'description' => "Description Here",
            'url' => "Prototyping.com",
            'is_public' => true,
        ]);

        $note = Note::create([
            'topic_id' => '1',
            'title' => "Element of fun",
            'description' => "Description Here",
            'url' => "eof.com",
            'is_public' => true,
        ]);

        $note = Note::create([
            'topic_id' => '2',
            'title' => "Social Media Marketing",
            'description' => "Description Here",
            'url' => "exampleofurl.com",
            'is_public' => true,
        ]);

        $note = Note::create([
            'topic_id' => '2',
            'title' => "Sampling",
            'description' => "Description Here",
            'url' => "exampleofurl.com",
            'is_public' => true,
        ]);

        $note = Note::create([
            'topic_id' => '2',
            'title' => "Budgeting",
            'description' => "Description Here",
            'url' => "exampleofurl.com",
            'is_public' => true,
        ]);

        for($i=0;$i<10;$i++){
            $note = Note::create([
                'topic_id' => Topic::all()->random()->id,
                'title' => $faker->words($nb = 2, $asText = true),
                'description' => $faker->sentence($nbWords = 7, $variableNbWords = true),
                'url' => $faker->url,
                'is_public' => true,
            ]);
        }

    }
}
