<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $customer = User::where('email', $request->email)->first();
        if(!$customer) return redirect()->back()->with('error', 'User Not found.');
        if (!Hash::check($request->password, $customer->password)) {
            return redirect()->back()->with('error', 'Given password is incorrect. Please try again with correct one. Thank you.');
        }
        Auth::guard('web')->login($customer);
        return redirect(route('home'))
        ->withSuccess('Signed in');
        // Auth::attempt(['email' => $request->email, 'password' => $request->password], false);
        // return redirect(route('home'))->with('success', 'Logged in successfully.');
        // if (Auth::attempt($credentials)) {
        //     return redirect(route('home'))
        //                 ->withSuccess('Signed in');
        // }
    }
}
