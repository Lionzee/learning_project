<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class Note extends Model
{
    use FullTextSearch;

    protected $table = 'notes';

    protected $fillable = [
        'topic_id', 'title', 'description','url','origin_id','is_public'
    ];

    protected $searchable = [
        'title','description'
    ];

    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id','id');
    }

    public static function checkDuplicateTitle($topic_id,$title){
        if(!Note::where('topic_id',$topic_id)->where('title',$title)->first()){
            return true;
        }else{
            return false;
        }
    }

    public static function copyReference($topic_id,$note_id){
        $ori_data = Note::find($note_id);
        $new_data = Note::create([
            'topic_id' => $topic_id,
            'title' => $ori_data->title,
            'description' => $ori_data->description,
            'url' => $ori_data->url,
            'is_public' => true,
            'origin_id' => $note_id,
        ]);

        return $new_data;
    }

    public static function checkOwner($note_id){
        $note_data = Note::where('id',$note_id)->first();
        if(!$note_data){
            return false;
        }

        if(Topic::where('id',$note_data->topic_id)->where('user_id',Auth::user()->id)->first()){
            return true;
        }else{
            return false;
        }
    }
}
