<?php

namespace App\Http\Controllers\API\SAQ;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $work = Work::create([
            'user_id' => Auth::user()->id,
            'quiz_id' => $request->quiz_id,
        ]);

        Answer::createSheet($work->id);

        return response()->json([
            "errorCode" => "00",
            "message" => "success create work",
            "data" => $work
        ]);

    }

    public function update(Request $request,$work_id){
        $work = Work::where('id',$work_id)->first();

        if(!$work){
            return response()->json([
                "errorCode" => "05",
                "message" => "no work found !"
            ],403);
        }

        if($request->has('is_visible')){
            $work->is_visible = $request->is_visible;
        }
        if($request->has('is_finished')){
            $work->is_finished = $request->is_finished;
        }

        $work->total_time = Work::getTotalTime($work_id);
        $work->save();
        return response()->json([
            "errorCode" => "00",
            "message" => "work data update success !",
            "data" => $work
        ]);
    }

    public function myWork(){
        $work = Work::with('user','quiz')
            ->orderBy('id','DESC')
            ->where('user_id',Auth::user()->id)
            ->paginate(10);

        return response()->json([
            "errorCode" => "00",
            "message" => "success create work",
            "data" => $work
        ]);

    }
}
