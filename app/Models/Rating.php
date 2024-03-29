<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['quiz_id','user_id','rate','review'];

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
