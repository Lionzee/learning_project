<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = ['work_id','question_id','answer','time_in_sec','is_correct'];

    public function work(){
        return $this->belongsTo(Work::class, 'work_id','id');
    }

    public function question(){
        return $this->hasOne(Question::class, 'question_id','id');
    }
}
