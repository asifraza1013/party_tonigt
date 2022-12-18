<?php

namespace App\Http\Middleware;

use App\Models\UserApp;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if($request->has('u') && $request->u){
            $user = UserApp::where('id', Crypt::decrypt($request->u))->first();
            if($user){
                $login = Auth::guard('client')->login($user);
            }
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
