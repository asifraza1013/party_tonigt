<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostManagementController extends Controller
{
    public function landingPage(Request $request)
    {
        $title = 'Landing Page';
        $noFooter = true;
        $selectedTab = ($request->filter) ? $request->filter : 'login';
        return view('frontend.auth.index', compact([
            'noFooter',
            'selectedTab',
            'title',
        ]));
    }

    public function newsFeed()
    {
        $title = 'News Feed Page';
        $user = Auth::user();
        $user->following_count = $user->followings()->count();
        $user->followers_count = $user->followers()->count();
        return view('frontend.landing_page', compact([
            'user',
            'title',
        ]));
    }


    public function createNewEvent(Request $request)
    {
        dd($request->all());
        $rules = [
            'title' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return redirect()->back()->with('error', $errors);
        }
    }
}
