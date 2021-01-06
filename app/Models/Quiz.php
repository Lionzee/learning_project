<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use FullTextSearch;

    protected $table = 'quizzes';

    protected $fillable = ['user_id','title','description','is_public','max_question'];

    protected $searchable = [
        'title'
    ];

    public static function is_exist($title){
        $quiz = Quiz::where('title',$title)->first();
        if($quiz){
            return true;
        }else{
            return false;
        }
    }

    public static function isOwner($quiz_id){
        $data = Quiz::find($quiz_id);

        if(!$data){
            return false;
        }

        if($data->user_id == Auth::user()->id){
            return true;
        }else{
            return false;
        }
    }
}
