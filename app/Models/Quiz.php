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

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function question(){
        return $this->hasMany(Question::class, 'quiz_id','id');
    }

    public function works(){
        return $this->hasMany(Work::class, 'quiz_id','id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class, 'quiz_id','id');
    }

    public function getAvgRatingAttribute(){
        $rating = Rating::where('quiz_id',$this->id)->avg('rate');
        if($rating){
            return $rating;
        }else{
            return 0;
        }
    }

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

    public static function getMaxQuestion($quiz_id){
        $quiz = Quiz::where('id',$quiz_id)->first();
        return $quiz->max_question;
    }
    public $appends = ['avg_rating'];

}
