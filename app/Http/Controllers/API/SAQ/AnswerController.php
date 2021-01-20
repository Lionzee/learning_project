<?php

namespace App\Http\Controllers\API\SAQ;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function getSheet(Request $request){
        $sheet = Answer::with('question')->where('work_id',$request->work_id)->get();
        if(!$sheet){
            return response()->json([
                "errorCode" => "05",
                "message" => "no answer sheets found !"
            ],403);
        }
        return response()->json([
            "errorCode" => "00",
            "message" => "success updata soal",
            "data" => $sheet
        ],200);
    }

    public function update(Request $request,$answer_id){
        $validator = Validator::make($request->all(), [
            'answer' => 'required',
            'time' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $sheet = Answer::with('question')->where('id',$answer_id)->first();
        if(!$sheet){
            return response()->json([
                "errorCode" => "05",
                "message" => "no answer sheets found !"
            ],403);
        }
        $sheet->answer = $request->answer;
        $sheet->time_in_sec = $request->time;
        $sheet->is_correct = Answer::isCorrect($sheet->question_id,$sheet->answer);
        $sheet->save();
        return response()->json([
            "errorCode" => "00",
            "message" => "success updata sheet",
            "data" => $sheet
        ],200);
    }
}
