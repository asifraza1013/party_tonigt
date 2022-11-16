<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function adminLogin()
    {
        $title = 'Admin Login';
        return view('auth.login', compact([
            'title',
        ]));
    }

    public function submitAdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect(route('home'))
                        ->withSuccess('Signed in');
        }

        return redirect()->back()->withSuccess('Login details are not valid');
    }
}
