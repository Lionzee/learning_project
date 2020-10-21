<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'topic_id', 'user_id'
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id')->select('id','username');
    }

    public static function isExist($topic_id){
        $data = Like::where('topic_id',$topic_id)->where('user_id',Auth::user()->id)->first();
        if($data){
            return true;
        }else{
            return false;
        }
    }

    public static function doLike($topic_id){
        $data = Like::create([
            'topic_id' => $topic_id,
            'user_id' => Auth::user()->id,
        ]);

        return $data;
    }

    public static function doUnlike($topic_id){
        $find = Like::where('user_id',Auth::user()->id)->where('topic_id',$topic_id)->first();
        $data = Like::find($find->id);
        $data->delete();
    }

    public static function getList($topic_id){
        $data = Like::select('id','user_id')->with('users')->where('topic_id',$topic_id)->get();

        return $data;
    }


}
