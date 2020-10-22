<?php

namespace App\Http\Controllers\API\SNS;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function getComment($topic_id){
        $data = Comment::with('users')->where('topic_id',$topic_id)->get();

        return response()->json([
            "errorCode" => "00",
            "message" => "succes get data : comment listed",
            "data" => $data
        ]);
    }

    public function store(Request $request,$topic_id){
        $data = Comment::doComment($topic_id, $request);
        return response()->json([
            "errorCode" => "00",
            "message" => "succes comment : comment posted",
            "data" => $data
        ]);
    }

    public function edit($comment_id, Request $request){
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(Comment::isOwner($comment_id)){
            $data = Comment::doEdit($request,$comment_id);
            return response()->json([
                "errorCode" => "00",
                "message" => "succes edit comment : edit submitted",
                "data" => $data
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "edit failed : cant find target comment id"
            ]);
        }
    }

    public function delete($comment_id){
        if(Comment::isOwner($comment_id)){
           Comment::doDelete($comment_id);
            return response()->json([
                "errorCode" => "00",
                "message" => "delete success : comment deleted"
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "delete failed : cant find target comment id"
            ]);
        }
    }
}
