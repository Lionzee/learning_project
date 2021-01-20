<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'works';

    protected $fillable = ['user_id','quiz_id','is_visible','is_finished','total_time'];

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function getPercentageAttribute(){
        $data = Answer::where('work_id',$this->id)->get();
        $correct = Answer::where('work_id',$this->id)->where('is_correct',true)->count();
        $percentage = $correct / count($data) * 100;
        return $percentage;
    }

    public static function  getTotalTime($work_id){
        $answer = Answer::where('work_id',$work_id)->sum('time_in_sec');
        return $answer;
    }

    public $appends = ['percentage'];
}
