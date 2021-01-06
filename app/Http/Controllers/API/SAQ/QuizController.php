<?php

namespace App\Http\Controllers\API\SAQ;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{

    public function  index(Request $request){
        if($request->search){
            $data = Quiz::orderBy('id','DESC')
                ->search($request->search)
                ->where('is_public',true)
                ->paginate(8);
        }else{
            $data = Quiz::orderBy('id','DESC')
                ->where('is_public','1')
                ->paginate(8);
        }

        return response()->json([
            "errorCode" => "00",
            "message" => "success get quizzs",
            "data" => $data
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(!Quiz::is_exist($request->title)){
            $quiz = Quiz::create([
                'user_id' => Auth::user()->id ,
                'title' => $request->title,
                'description' => $request->desc,
                'is_public' => $request->is_public,
                'max_question' => $request->max_question,
            ]);

            return response()->json([
                "errorCode" => "00",
                "message" => "success create quiz",
                "data" => $quiz
            ]);
        }else{
            return response()->json([
                "errorCode" => "04",
                "message" => "failed create quiz : duplicate title"
            ]);
        }
    }

    public function update(Request $request,$quiz_id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'is_public' => 'required',
            'max_question' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(Quiz::isOwner($quiz_id)){
            $data = Quiz::where('id',$quiz_id)->first();
            $data->title = $request->title;
            $data->description = $request->desc;
            $data->is_public = $request->is_public;
            $data->max_question = $request->max_question;
            $data->save();

            return response()->json([
                "errorCode" => "00",
                "message" => "success updata quiz",
                "data" => $data
            ],200);

        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed to update : can't find any quiz"
            ],403);
        }
    }

    public function delete($quiz_id){
        if(Quiz::isOwner($quiz_id)){
            $data = Quiz::find($quiz_id);
            $data->delete();
            return response()->json([
                "errorCode" => "00",
                "message" => "quiz deleted !"
            ],200);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed to delete : can't find any quiz"
            ],403);
        }
    }
}
