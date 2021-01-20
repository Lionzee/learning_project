<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = ['work_id','question_id','answer','time_in_sec','is_correct'];

    public static function createSheet($work_id){
        $work = Work::where('id',$work_id)->first();
        $quiz = Quiz::where('id',$work->quiz_id)->first();

        $questions = Question::where('quiz_id',$quiz->id)->inRandomOrder()->limit($quiz->max_question)->pluck('id');
        for($i=0;$i<count($questions);$i++){
            $answer = Answer::create([
                'work_id' => $work_id,
                'question_id' => $questions[$i],
            ]);
        }
    }

    public static function isCorrect($question_id,$answer){
        $question = Question::where('id',$question_id)->first();
        if($answer == $question->correct_answer){
            return true;
        }else{
            return false;
        }
    }

    public function work(){
        return $this->belongsTo(Work::class, 'work_id','id');
    }

    public function question(){
        return $this->hasOne(Question::class, 'id','question_id');
    }
}
