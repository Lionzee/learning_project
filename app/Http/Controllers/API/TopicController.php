<?php

namespace App\Http\Controllers\API;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{

    public function index(Request $request)
    {
        if($request->search){
            $data = Topic::orderBy('id','DESC')
                ->search($request->search)
                ->where('is_public',true)
                ->paginate(8);

            /*$data = Topic::orderBy('id','DESC')
                ->where('title','LIKE',"%$request->search%")
                ->where('is_public',true)
                ->paginate(8);*/
        }else{
            $data = Topic::orderBy('id','DESC')
                ->where('is_public','1')
                ->paginate(8);
        }

        return response()->json([
            "errorCode" => "00",
            "message" => "success get news",
            "data" => $data
        ]);
    }


    public function store(Request $request)
    {
        if(!Topic::where('user_id',Auth::user()->id)->where('title',$request->title)->first()){
            $topic = Topic::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public
            ]);

            return response()->json([
                "errorCode" => "00",
                "message" => "success create topic",
                "data" => $topic
            ]);
        }else{
            return response()->json([
                "errorCode" => "04",
                "message" => "failed create topic : duplicate title"
            ]);
        }
    }

    public function update(Request $request, $topic_id)
    {
        $data = Topic::where('user_id',Auth::user()->id)->where('id',$topic_id)->first();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'is_public' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if($data){
            $data->title = $request->title;
            $data->description = $request->desc;
            $data->is_public = $request->is_public;
            $data->save();

            return response()->json([
                "errorCode" => "00",
                "message" => "update success : topic updated",
                "data" => $data,
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed edit topic : can't find any topic"
            ]);
        }
    }


    public function destroy($topic_id)
    {
        $data = Topic::where('user_id',Auth::user()->id)->where('id',$topic_id)->first();
        if($data){
            $destroydata =Topic::find($topic_id);
            $destroydata->delete();

            return response()->json([
                "errorCode" => "00",
                "message" => "topic delete success : topic deleted"
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "topic delete failed : can't find any topic"
            ]);
        }
    }
}
