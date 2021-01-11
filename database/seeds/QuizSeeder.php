<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use Faker\Factory as Faker;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        //Quiz 1
        $quiz_1 = Quiz::create([
            'user_id' => User::all()->random()->id,
            'title' => "Matematika Kelas 3 SD",
            'description' => "Soal matematika untuk kelas 3 SD",
            'is_public' => true,
            'max_question' => 10,
        ]);

        //Quiz 1 Questions
        $question1_1 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "Bilangan A berada di antara 355 dan 357. Bilangan A jika ditambah 100 maka hasilnya adalah ….",
            'answer_1' => "455",
            'answer_2' => "456",
            'answer_3' => "457",
            'answer_4' => "458",
            'correct_answer' => 2,
        ]);

        $question1_2 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "5 – 17 – 29 – 41 – 53 – 65",
            'answer_1' => "5",
            'answer_2' => "17",
            'answer_3' => "12",
            'answer_4' => "15",
            'correct_answer' => 3,
        ]);

        $question1_3 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "Barisan bilangan meloncat 6 dimulai dari 6 adalah ….",
            'answer_1' => "6 – 12 – 18 – 21 – 27",
            'answer_2' => "6 – 12 – 18 – 24 – 30",
            'answer_3' => "6 – 12 – 15 – 22 – 30",
            'answer_4' => "6 – 12 – 18 – 22 – 30",
            'correct_answer' => 2,
        ]);

        $question1_4 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "Hasil dari 3147 + 1897 adalah ….",
            'answer_1' => "5134",
            'answer_2' => "5244",
            'answer_3' => "5044",
            'answer_4' => "5174",
            'correct_answer' => 3,
        ]);

        $question1_5 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "Bilangan tujuh ribu delapan ratus enam puluh lima ditulis ….",
            'answer_1' => "7865",
            'answer_2' => "7568",
            'answer_3' => "70568",
            'answer_4' => "78605",
            'correct_answer' => 1,
        ]);

        $question1_6 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "Pak Dadang telah memanen semangka sebanyak 1.325 buah. Sebanyak 720 semangka dijual ke pasar. Semangka yang masih terjual adalah sebanyak ….",
            'answer_1' => "705",
            'answer_2' => "605",
            'answer_3' => "695",
            'answer_4' => "755",
            'correct_answer' => 2,
        ]);



        $question1_7 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "Selisih antara nilai angka 6 dan 4 pada bilangan 6.245 adalah",
            'answer_1' => "5900",
            'answer_2' => "2000",
            'answer_3' => "2",
            'answer_4' => "5960",
            'correct_answer' => 4,
        ]);

        $question1_8 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "25 x 12 = ...",
            'answer_1' => "200",
            'answer_2' => "300",
            'answer_3' => "250",
            'answer_4' => "350",
            'correct_answer' => 2,
        ]);

        $question1_9 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "59 x 31 = ...",
            'answer_1' => "1829",
            'answer_2' => "1209",
            'answer_3' => "1329",
            'answer_4' => "1928",
            'correct_answer' => 1,
        ]);

        $question1_10 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "Pak Jaya membeli 9 kardus mie instan. Setiap kardus berisi 24 bungkus mie. Berapa bungkus jumlah seluruh mie yang dibeli Pak jaya ?",
            'answer_1' => "226 bungkus",
            'answer_2' => "216 bungkus",
            'answer_3' => "196 bungkus",
            'answer_4' => "206 bungkus",
            'correct_answer' => 2,
        ]);

        $question1_11 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "175 : 25 = ",
            'answer_1' => "15",
            'answer_2' => "7",
            'answer_3' => "9",
            'answer_4' => "18",
            'correct_answer' => 2,
        ]);

        $question1_12 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "154 : 11 x 2 = ",
            'answer_1' => "12",
            'answer_2' => "13",
            'answer_3' => "28",
            'answer_4' => "15",
            'correct_answer' => 3,
        ]);

        /*$question1_5 = Question::create([
            'quiz_id' => $quiz_1->id,
            'body' => "",
            'answer_1' => "",
            'answer_2' => "",
            'answer_3' => "",
            'answer_4' => "",
            'correct_answer' => 1,
        ]);*/

    }
}
