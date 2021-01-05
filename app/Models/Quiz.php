<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
