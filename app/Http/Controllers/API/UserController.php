<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $username = User::where('username', $request->username)->first();
        $email = User::where('email', $request->email)->first();

        if ($username) {
            return response()->json([
                "errorCode" => "03",
                "message" => "username has been taken",
                "data" => null
            ]);
        }

        if ($email) {
            return response()->json([
                "errorCode" => "04",
                "message" => "email has been taken",
                "data" => null
            ]);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => 2,
            'password' => Hash::make($request->password),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'display_name' => $request->display_name,
            'phone_number' => $request->phone_number,
        ]);

        $user->token = JWTAuth::fromUser($user);

        return response()->json([
            "errorCode" => "00",
            "message" => "success register",
            "data" => $user
        ]);
    }

    public function login(Request $request)
    {

        $credentials = $request->only('username', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    "errorCode" => "02",
                    "message" => "wrong username / password ",
                    "data" => null
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                "errorCode" => "99",
                "message" => "invalid token",
                "data" => null
            ]);
        }

        return response()->json([
            "errorCode" => "00",
            "message" => "success",
            "data" => compact('token')
        ]);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    "errorCode" => "01",
                    "message" => "user not found ",
                    "data" => null
                ]);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json([
                "errorCode" => "06",
                "message" => "token expired",
                "data" => null
            ]);

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                "errorCode" => "99",
                "message" => "invalid token",
                "data" => null
            ]);

        }

        $user = User::with(['profile'])->find($user->id);

        return response()->json([
            "errorCode" => "00",
            "message" => "success",
            "data" => $user
        ]);
    }

    public function editProfile(Request $request){
        $user = UserProfile::where('user_id',Auth::user()->id)->first();

        $validator = Validator::make($request->all(), [
            'display_name' => 'required',
            'birth_date' => 'required',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if (!$user) {
            $user = UserProfile::create([
                'user_id' => auth()->user()->id,
                'display_name' => $request->display_name,
                'bio' => $request->bio,
                'birth_date' => $request->birth_date,
                'website' => $request->website,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'occupation' => $request->occupation
            ]);

            return response()->json($user);

        } else {
            $user->display_name = $request->display_name;
            $user->bio = $request->bio;
            $user->birth_date = $request->birth_date;
            $user->website = $request->website;
            $user->phone_number = $request->phone_number;
            $user->city = $request->city;
            $user->occupation = $request->occupation;
            $user->save();
            return response()->json([
                "errorCode" => "00",
                "message" => "success",
                "data" => $user
            ]);
        }

    }

    public function getProfile() {
        $profile = UserProfile::find(auth()->user()->id);
        return response()->json([
            "errorCode" => "00",
            "message" => "success",
            "data" => $profile
        ]);
    }

}
