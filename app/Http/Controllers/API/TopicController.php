<?php

namespace App\Http\Controllers\API;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{

    public function index()
    {

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


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
