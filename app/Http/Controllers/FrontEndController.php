<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ContactusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontEndController extends Controller
{
    public function privacyPolicy()
    {
        $title = 'Privacy Policy';
        return view('frontend.staticPages.privacy_policy', compact([
            'title',
        ]));
    }

    public function termsConditions()
    {
        $title = 'Terms and Conditions';
        return view('frontend.staticPages.terms_conditions', compact([
            'title',
        ]));
    }

    public function contactusIndex()
    {
        $title = 'Contact us';
        return view('frontend.staticPages.contact_us', compact([
            'title',
        ]));
    }

    public function submitContactUs(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'phone' => 'required|string',
            'name' => 'required|string',
            'message' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return redirect()->back()->with('error', $errors);
        }
        $user = User::where('email', 'admin@tonightParty.com')->first();
        $user->notify(new ContactusNotification($request->all()));

        return redirect()->back()->with('info', 'Thanks for reaching us out. Your query is already sent to our support. We will get back to you soon.');
    }
}
