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
            "message" => "success create quiz",
            "data" => $work
        ]);

    }
}
