<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count = User::all()->count();
        $user_thismonth = User::whereMonth('created_at', '=', Carbon::now()->month)->count();

        $topic_count = Topic::all()->count();
        $topic_thisweek = Topic::getThisWeekTopicCount();


        return view('admin.home',compact(['user_count','user_thismonth','topic_count','topic_thisweek']));
    }
}
