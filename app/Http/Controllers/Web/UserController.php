<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\UserApp;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Web Client Routes
    */

    public function webClientSignUp(Request $request)
    {
        $rules = [
            // 'user_name' => 'required|string',
            // 'country' => 'required|string',
            // 'dob' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|email|unique:user_apps,email',
            'password' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return redirect()->back()->with('error', $errors);
        }

        $createUser= new UserApp();
        $createUser->user_name = strtolower($request->first_name).'_'.strtolower($request->last_name).rand(0000, 9999);
        $createUser->first_name = $request->first_name;
        $createUser->last_name = $request->last_name;
        $createUser->country = $request->country;
        $createUser->gender = $request->gender;
        $createUser->email = $request->email;
        $createUser->password = Hash::make($request->password);
        $createUser->admin_approved = true;
        $createUser->status = 3; // unverified by default

        if($request->day && $request->month && $request->year){
            $createUser->dob = $request->day.'-'.$request->month.'-'.$request->year;
        }
        $createUser->save();

        if($createUser){
           /**
            * TODO: send OTP to user for verification
            */
            return redirect(route('client.verification.screen', [Crypt::encrypt($createUser->id), true]));
        }

        return redirect()->back()->with('error', 'Opps! Something went wrong. Please try again.');
    }

    public function webClientVerification($user, $sendOtp = false)
    {
        $noFooter = true;
        $title = 'Account Verification Screen';
        $user = UserApp::where('id', Crypt::decrypt($user))->first();
        if(is_null($user)) {
            toastr()->error('Opss! can\'t find user detail. Please try with correct data.');
            return redirect(route('login'));
        }
        if($user->status != 3){
            toastr()->warning('Your account is already verified. Please try login.');
            return redirect(route('login', ['filter' => 'login']));
        }

        if($sendOtp){

            // send email notification
            $otp = rand(0000, 9999);
           Log::info("OTP user ".$user->id. ' OTP '.$otp);

            $user->notify(new SendOtpNotification($user, $otp));
            $user->otp = $otp;
            $user->update();
            return redirect(route('client.verification.screen', Crypt::encrypt($user->id)));
        }

        return view('frontend.auth.verification', compact([
            'noFooter',
            'title',
            'user',
        ]));
    }

    public function webClientOtpVerification(Request $request)
    {
        $rules = [
            'user' => 'required|string',
            'otp' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return redirect()->back()->with('error', $errors);
        }

        $userapp = UserApp::where('id', Crypt::decrypt($request->user))->first();
        Log::info("userapp OTP ".json_encode($userapp));
        if($userapp->otp == null || $request->otp != $userapp->otp){
            return redirect()->back()->with('error', 'OTP is not correct. Please try enter correct one. Thank you.');
        }

        $userapp->otp = null;
        $userapp->status = 1;
        $userapp->update();

        return redirect(route('login', ['filter' => 'login']))->with('success', 'Account verificaiton is successfull. Please try login and enjoy your community. Thank you.');
    }

    public function webClientEmailLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return redirect()->back()->with('error', $errors);
        }

        $customer = UserApp::where('email', $request->email)
        ->first();

        if(is_null($customer)){
            return redirect(route('login', ['filter' => 'register']))->with('error', 'Can\'t find account. Please try signup');
        }

        if($customer->status == 3){
            return redirect(route('client.verification.screen', [Crypt::encrypt($customer->id), true]))->with('Please verify yourself before you procceed. Thank you.');
        }

        if($customer->status == 2){
            return redirect()->back()->with('warning', 'Opps, your account terminated. Please contact admin. Thank you.');
        }
        if (!Hash::check($request->password, $customer->password)) {
            return redirect()->back()->with('error', 'Given password is incorrect. Please try again with correct one. Thank you.');
        }

        Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], false);
        return redirect(route('client.news.feed'))->with('success', 'Logged in successfully.');
    }
}