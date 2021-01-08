<?php

namespace App\Http\Controllers\API\SAQ;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function getQuestion(Request $request){
        if(Quiz::isOwner($request->quiz_id)){
            $data = Question::where('quiz_id',$request->quiz_id)->get();
            return response()->json([
                "errorCode" => "00",
                "message" => "success get all question",
                "data" => $data
            ],200);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed to get : can't find any quiz or you have no access"
            ],403);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
            'body' => 'required',
            'answer_1' => 'required',
            'answer_2' => 'required',
            'answer_3' => 'required',
            'answer_4' => 'required',
            'correct_answer' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(Quiz::isOwner($request->quiz_id)){
            if(!Question::isDuplicate($request->quiz_id,$request->body)){
                $data = Question::create([
                    'quiz_id' => $request->quiz_id,
                    'body' => $request->body,
                    'answer_1' => $request->answer_1,
                    'answer_2' => $request->answer_2,
                    'answer_3' => $request->answer_3,
                    'answer_4' => $request->answer_4,
                    'correct_answer' => $request->correct_answer,
                ]);

                return response()->json([
                    "errorCode" => "00",
                    "message" => "success updata quiz, question added",
                    "data" => $data
                ],200);
            }else{
                return response()->json([
                    "errorCode" => "04",
                    "message" => "failed create question : duplicate body"
                ]);
            }
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed to update : can't find any quiz or you have no access"
            ],403);
        }
    }

    public function update(Request $request,$question_id){
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'answer_1' => 'required',
            'answer_2' => 'required',
            'answer_3' => 'required',
            'answer_4' => 'required',
            'correct_answer' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $question = Question::where('id',$question_id)->first();

        if(!$question){
            return response()->json([
                "errorCode" => "05",
                "message" => "failed to update : can't find any question"
            ],403);
        }else{
            $question->body = $request->body;
            $question->answer_1 = $request->answer_1;
            $question->answer_2 = $request->answer_2;
            $question->answer_3 = $request->answer_3;
            $question->answer_4 = $request->answer_4;
            $question->correct_answer = $request->correct_answer;
            $question->save();

            return response()->json([
                "errorCode" => "00",
                "message" => "success updata soal",
                "data" => $question
            ],200);
        }
    }

    public function delete($question_id){
        $question = Question::where('id',$question_id)->first();
        if(!$question){
            return response()->json([
                "errorCode" => "05",
                "message" => "failed to delete : can't find any question"
            ],403);
        }

        if(Quiz::isOwner($question->quiz_id)){
            $data = Question::find($question_id);
            $data->delete();
            return response()->json([
                "errorCode" => "00",
                "message" => "question deleted !"
            ],200);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed to delete : can't find question with that id"
            ],403);
        }
    }


}
