<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['quiz_id','image_url','body','answer_1','answer_2','answer_3','answer_4','correct_answer'];

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id','id');
    }

    public static function isDuplicate($quiz_id,$body){
        $data = Question::where('body',$body)->where('quiz_id',$quiz_id)->first();
        if($data){
            return true;
        }else{
            return false;
        }
    }



}
