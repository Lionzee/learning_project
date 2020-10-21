<?php

namespace App\Http\Controllers\API\SNS;

use App\Models\Note;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Matcher\Not;

class NoteController extends Controller
{
    public function index(Request $request){
        if($request->search){
            $data = Note::orderBy('id','DESC')
                ->search($request->search)
                ->where('is_public',true)
                ->paginate(8);

        }else{
            $data = Note::orderBy('id','DESC')
                ->where('is_public',true)
                ->paginate(8);
        }

        return response()->json([
            "errorCode" => "00",
            "message" => "success get references",
            "data" => $data
        ]);
    }

    public function store(Request $request,$topic_id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'url' => 'required',
            'is_public' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(Topic::checkOwner($topic_id)){
            if(Note::checkDuplicateTitle($topic_id,$request->title)){
                $data = Note::create([
                    'topic_id' => $topic_id ,
                    'title' => $request->title,
                    'description' => $request->desc ,
                    'url' => $request->url,
                    'is_public' => $request->is_public
                ]);

                return response()->json([
                    "errorCode" => "00",
                    "message" => "success create reference : reference created",
                    "data" => $data
                ]);
            }else{
                return response()->json([
                    "errorCode" => "04",
                    "message" => "failed create reference : duplicate title"
                ]);
            }
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed create reference : can't find target topic"
            ]);
        }
    }

    public function update(Request $request,$note_id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'url' => 'required',
            'is_public' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(Note::checkOwner($note_id)){
            $data = Note::find($note_id);
            $data->title = $request->title;
            $data->description = $request->desc;
            $data->url = $request->url;
            $data->is_public = $request->is_public;
            $data->save();

            return response()->json([
                "errorCode" => "00",
                "message" => "success edit reference : reference updated",
                "data" => $data
            ]);

        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed edit reference : can't find target note"
            ]);
        }

    }

    public function getNotes($topic_id){
        if(!Topic::where('id',$topic_id)->first()){
            return response()->json([
                "errorCode" => "05",
                "message" => "failed get note : topic not available"
            ]);
        }

        if(Topic::checkOwner($topic_id)){
            $data = Note::where('topic_id',$topic_id)->get();
            return response()->json([
                "errorCode" => "00",
                "message" => "succes get note : note listed",
                "data" => $data
            ]);
        }else{
            $data = Note::where('topic_id',$topic_id)->where('is_public',true)->get();
            return response()->json([
                "errorCode" => "00",
                "message" => "succes get note : note listed",
                "data" => $data
            ]);
        }
    }

    public function copy(Request $request,$note_id){
        $topic_id = $request->topic_id;
        if(!Note::checkOwner($note_id)){
            if(Topic::checkOwner($topic_id)){
                $data = Note::copyReference($topic_id,$note_id);

                return response()->json([
                    "errorCode" => "00",
                    "message" => "succes copy note : note created",
                    "data" => $data
                ]);
            }else{
                return response()->json([
                    "errorCode" => "05",
                    "message" => "failed copy reference : cant find selected topic"
                ]);
            }
        }else{
            return response()->json([
                "errorCode" => "04",
                "message" => "failed copy reference : duplicate entry"
            ]);
        }
    }

    public function delete($note_id){
        if(Note::checkOwner($note_id)){
            $data = Note::find($note_id);
            $data->delete();

            return response()->json([
                "errorCode" => "00",
                "message" => "success delete note : note deleted"
            ]);
        }else{
            return response()->json([
                "errorCode" => "05",
                "message" => "failed delete note : note not available"
            ]);
        }
    }
}
