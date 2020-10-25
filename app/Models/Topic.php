<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Topic extends Model
{
    use FullTextSearch;

    protected $table = 'topics';

    protected $fillable = [
        'user_id', 'title', 'description','origin_id','is_public'
    ];

    protected $searchable = [
        'title','description'
    ];

    public static function checkOwner($topic_id){
        if(Topic::where('user_id',Auth::user()->id)->where('id',$topic_id)->first()){
            return true;
        }else{
            return false;
        }
    }

    public static function copyTopic($topic_id){
        $ori_topic = Topic::find($topic_id);
        $ori_notes = Note::orderBy('id','ASC')
            ->where('topic_id',$topic_id)
            ->get()
            ->toArray();

        // new topic
        $new_topic = Topic::create([
            'user_id' => Auth::user()->id,
            'title' => $ori_topic->title,
            'description' => $ori_topic->description,
            'is_public' => $ori_topic->is_public,
            'origin_id' => $ori_topic->id
        ]);

        //new references
        for($i=0;$i<count($ori_notes);$i++){
            $new_notes = Note::create([
                'topic_id' => $new_topic->id,
                'title' => $ori_notes[$i]['title'],
                'description' => $ori_notes[$i]['description'],
                'url' => $ori_notes[$i]['url'],
                'is_public' => $ori_notes[$i]['is_public'],
                'origin_id' => $ori_notes[$i]['id'],
            ]);
        }

        return $new_topic;
    }

    public static function getThisWeekTopicCount(){
        $start_week = strtotime("last sunday midnight");
        $end_week = strtotime("next saturday");
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        $data = Topic::whereBetween('created_at', [$start_week, $end_week])->get();
        return count($data);
    }

    public function getLikesCountAttribute(){
        $count = count(Like::where('topic_id',$this->id)->get());
        return $count;
    }

    public function getLikeStatusAttribute(){
        if(DB::table('likes')->where('likes.user_id',Auth::user()->id)->where('likes.topic_id',$this->id)->first()){
            $status = 1;
        }else{
            $status = 0;
        }
        return $status;
    }

    public function getCommentsCountAttribute(){
        $count = count(Comment::where('topic_id',$this->id)->get());
        return $count;
    }

    public $appends = ['like_status','likes_count','comments_count'];


}
