<?php

namespace App\Http\Controllers\API\SAQ;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
            'rate' => 'required|integer|between:1,5',
            'review' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $rating = Rating::create([
            'quiz_id' => $request->quiz_id,
            'user_id' => Auth::user()->id,
            'rate' => $request->rate,
            'review' => $request->review,
        ]);

        return response()->json([
            "errorCode" => "00",
            "message" => "success create rating",
            "data" => $rating
        ]);

    }

    public function getQuizRating($quiz_id){
        $rating = Rating::with('user')->where('quiz_id',$quiz_id)->get();
        if($rating){
            return response()->json([
                "errorCode" => "00",
                "message" => "success create rating",
                "data" => $rating
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "can't find any ratings",
            ]);
        }
    }
}
