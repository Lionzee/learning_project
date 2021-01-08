<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'wprks';

    protected $fillable = ['user_id','quiz_id','is_visible','is_finished','total_time'];

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id','id');
    }
}
