<?php

namespace App\Http\Controllers\API\SNS;

use App\Http\Controllers\Controller;
use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store($target_id){

        if(Auth::user()->id == $target_id){
            return response()->json([
                "errorCode" => "03",
                "message" => "follow failed : cant follow yourself"
            ]);
        }

        if(Following::isExist($target_id)){
            return response()->json([
                "errorCode" => "04",
                "message" => "follow failed : duplicate entry"
            ]);
        }else{
            $data = Following::doFollow($target_id);
            return response()->json([
                "errorCode" => "00",
                "message" => "succes follow : user followed",
                "data" => $data
            ]);
        }
    }

    public function getFollower($user_id){
        $data = Following::select('user_id','follower_name')->where('target_user',$user_id)->get();

        return response()->json([
            "follower_count" => count($data),
            "errorCode" => "00",
            "message" => "succes get follower : follower listed",
            "data" => $data,

        ]);
    }

    public function getFollowing($user_id){
        $data = Following::select('target_user','target_name')->where('user_id',$user_id)->get();

        return response()->json([
            "following_count" => count($data),
            "errorCode" => "00",
            "message" => "succes get following : following listed",
            "data" => $data,

        ]);
    }

    public function unfollow($user_id){
        if(Following::isExist($user_id)){
            Following::doUnfollow($user_id);

            return response()->json([
                "errorCode" => "00",
                "message" => "unfollow success : user unfollowed"
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "unfollow failed : cant find target user"
            ]);
        }
    }
}
