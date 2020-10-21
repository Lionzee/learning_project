<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Following extends Model
{
    protected $table = 'followings';

    protected $fillable = [
        'user_id', 'follower_name', 'target_user','target_name'
    ];

    public static function isExist($target_id){
        $user_id = Auth::user()->id;
        $check = Following::where('user_id',$user_id)->where('target_user',$target_id)->first();
        if($check){
            return true;
        }else{
            return false;
        }
    }

    public static function doFollow($target_id){
        $user_id = Auth::user()->id;
        $follower_data = User::where('id',$user_id)->first();
        $target_id = User::where('id',$target_id)->first();
        $data = Following::create([
            'user_id' => $follower_data->id,
            'follower_name' => $follower_data->username,
            'target_user' => $target_id->id,
            'target_name' => $target_id->username,
        ]);

        return $data;
    }

    public static function doUnfollow($user_id){
        $data = Following::where('user_id',Auth::user()->id)->where('target_user',$user_id)->first();
        $result = Following::find($data->id);
        $result->delete();
    }
}
