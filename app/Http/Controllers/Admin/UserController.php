<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //
    public function index() {

        $datas = User::with('profile')->get();

        return view('admin.user',compact(['datas']));
    }

    public function show($id) {
        $find = User::find($id);
        $data = User::with('profile')->where('id',$find->id)->first();

        return view('admin.user-edit', compact(['data']));
    }

    public function update(Request $request, $id) {
        $data = User::find($id);
        $profile = UserProfile::where('user_id',$id)->first();

        $data->username = $request->username;
        $data->email = $request->email;
        if($data->email_verified_at == NULL && $request->verified == true){
            $data->email_verified_at = Carbon::now();
        }elseif($data->email_verified_at != NULL && $request->verified == false){
            $data->email_verified_at = NULL;
        }
        $data->save();
        $profile->display_name = $request->display_name;
        $profile->save();

        $successMessage = "Success update user! ";
        return redirect('/admin/user')->with('success', $successMessage);

    }


}
