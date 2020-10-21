<?php

namespace App\Http\Controllers\API\SNS;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Topic;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store($topic_id){
        if(Like::isExist($topic_id)){
            return response()->json([
                "errorCode" => "04",
                "message" => "like failed : duplicate entry"
            ]);
        }else{
            $data = Like::doLike($topic_id);
            return response()->json([
                "errorCode" => "00",
                "message" => "succes like : topic liked",
                "data" => $data
            ]);
        }
    }

    public function unlike($topic_id){
        if(Like::isExist($topic_id)){
            Like::doUnlike($topic_id);

            return response()->json([
                "errorCode" => "00",
                "message" => "succes unlike : topic unliked",
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "Unlike failed : cant find target topic"
            ]);
        }
    }

    public function likeDetails($topic_id){
        $data = Like::getList($topic_id);

        return response()->json([
            "errorCode" => "00",
            "message" => "succes get list : list data listed",
            "data" => $data
        ]);
    }
}
