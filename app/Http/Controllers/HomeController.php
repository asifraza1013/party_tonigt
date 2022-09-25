<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\UserApp;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function redirect()
    {
        return redirect(route('home'))->with('success', 'Login success');
    }

    public function userAppList(Request $request)
    {
        $users = UserApp::orderBy('id','ASC')->paginate(5);
        return view('userapps.index',compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function showUserAppDetail(Request $request, $id)
    {
        $user = UserApp::where('id',$id)->first();
        return view('userapps.show',compact('user'));
    }
}
