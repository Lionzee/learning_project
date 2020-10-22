<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'topic_id', 'user_id', 'content'
    ];


    public function users(){
        return $this->belongsTo(User::class,'user_id','id')->select('id','username');
    }

    public function getIsMineAttribute(){
        if(Comment::where('id',$this->id)->where('user_id',Auth::user()->id)->first()){
            return 1;
        }else{
            return 0;
        }
    }

    public static function isOwner($comment_id){
        $check = Comment::where('id',$comment_id)->where('user_id',Auth::user()->id)->first();
        if($check){
            return true;
        }else{
            return false;
        }
    }

    public static function doComment($topic_id,$request){
        $data = Comment::create([
            'topic_id' => $topic_id,
            'user_id' => Auth::user()->id,
            'content' => $request->content
        ]);

        return $data;
    }

    public static function doEdit($request,$comment_id){
        $data = Comment::find($comment_id);
        $data->content = $request->content;
        $data->save();

        return $data;
    }

    public static function doDelete($comment_id){
        $data = Comment::find($comment_id);
        $data->delete();
    }

    public $appends = ['is_mine'];

}
