<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use App\Models\Post;
use App\Models\Tag;
use App\Models\UserApp;
use App\Notifications\SendOtpNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Tags\Tag as TagsTag;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:client')->except('logout');
    // }

     /**
     * signup for customer
     */
    public function userSignUp(Request $request)
    {
        $rules = [
            // 'user_name' => 'required|string',
            // 'country' => 'required|string',
            // 'dob' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|email',
            'password' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return response()->json(['status' => false, 'status_code' => 1013, 'data' => $errors]);
        }

        $exist = UserApp::where('email', $request->email)->first();
        if($exist){
            return response()->json([
                'status' => false,
                'code' => config('response.5000.code'),
                'message' => config('response.5000.message'),
            ]);
        }

        $createUser= new UserApp;
        $createUser->user_name = $request->user_name;
        $createUser->first_name = $request->first_name;
        $createUser->last_name = $request->last_name;
        $createUser->country = $request->country;
        $createUser->dob = $request->dob;
        $createUser->gender = $request->gender;
        $createUser->email = $request->email;
        $createUser->password = Hash::make($request->password);
        $createUser->admin_approved = true;
        $createUser->status = 3; // unverified by default
        $createUser->save();

        if($createUser){
           /**
            * TODO: send OTP to user for verification
            */
            return response()->json([
                'status' => true,
                'user' => $createUser,
                'code' => config('response.1004.code'),
                'message' => config('response.1004.message'),
            ]);
        }

        return response()->json([
            'status' => false,
            'code' => config('response.1003.code'),
            'message' => config('response.1003.message'),
        ]);
    }


    /**
     * customer login
     */
    public function customerEmailLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string',
            'device_token' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return response()->json(['status' => false, 'status_code' => 1013, 'data' => $errors]);
        }

        $customer = UserApp::where('email', $request->email)
        ->first();

        if(is_null($customer)){
            return response()->json([
                'status' => false,
                'code' => config('response.1005.code'),
                'message' => config('response.1005.message'),
            ]);
        }

        if($customer->status == 3){
            return response()->json([
                'status' => false,
                'user' => (object)['id'=> $customer->id, 'first_name' => $customer->first_name, 'last_name' => $customer->last_name, 'user_name' => $customer->user_name],
                'code' => config('response.1006.code'),
                'message' => config('response.1006.message'),
            ]);
        }

        if($customer->status == 2){
            return response()->json([
                'status' => false,
                'code' => config('response.1015.code'),
                'message' => config('response.1015.message'),
            ],401);
        }
        if (!Hash::check($request->password, $customer->password)) {
            return response()->json([
                'status' => false,
                'code' => config('response.401.code'),
                'message' => config('response.401.message'),
                'error' => 'Unauthenticated.'
            ], 401);
        }
        $tokenResult = $customer->createToken('auth_token')->plainTextToken;
        // return response()->json($tokenResult);
        // $token = $tokenResult->access_token;
        // if ($request->remember_me)
        //     $token->expires_at = Carbon::now()->addWeeks(1);
        // $token->save();

        // store deive token
        $device_token = DeviceToken::updateOrCreate(
            [
                'user_apps_id' => $customer->id,
                'device_token' => $request->device_token,
            ],
            [
                'user_apps_id' => $customer->id,
                'device_token' => $request->device_token
            ]
        );

        $data = [
            'id' => $customer->id,
            'name' => $customer->user_name,
            'country' => $customer->country,
            'email' => $customer->email,
            'image' => (is_null($customer->image)) ? null : $customer->image,
            'enable_notifications' => $customer->enable_notifications,
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            // 'expires_at' => Carbon::parse(
            //     $tokenResult->token->expires_at
            // )->toDateTimeString()
        ];
        return response()->json([
            'status' => true,
            'user' => $data,
            'code' => config('response.1002.code'),
            'message' => config('response.1002.message'),
        ]);
    }


    /**
     * update profile image
     */
    public function updateProfileImage(Request $request)
    {
        $rules = [
            'image' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return response()->json(['status' => false, 'status_code' => 1013, 'data' => $errors]);
        }

        $user = $request->user();

        $image = $request->image;  // your base64 encoded
        $mediaType = get_string_between($image, 'data:', '/');
        Log::info('mediaType - '.$mediaType);

        $mediaExten = get_string_between($image, 'data:'.$mediaType.'/', ';base64');
        Log::info('mediaExten - '.$mediaExten);

        $image = str_replace('data:'.$mediaType.'/'.$mediaExten.';base64,', '', $image);
        $imageName = Str::random(20).'.'.$mediaExten;

        File::put(public_path('uploads/'.$imageName), base64_decode($image));

        if($user->image){
            File::delete(public_path('uploads/'.$user->image));
        }

        $user->image = asset('uploads/'.$imageName);
        $user->save();
        return response()->json([
            'status' => true,
            'code' => config('response.1008.code'),
            'message' => config('response.1008.message'),
        ]);
    }

    /**
     * send OTP
     */
    public function sendOtp(Request $request)
    {
        // $rules = [
        //     'user_id' => 'nullable|numeric',
        //     'email' => 'nullable|numeric',
        // ];

        // $validator = Validator::make($request->all(), $rules);
        // $errors = error_msg_serialize($validator->errors());
        // if (count($errors) > 0)
        // {
        //     return response()->json(['status' => false, 'status_code' => 1013, 'data' => $errors]);
        // }

       $otp = rand(0000, 9999);
       Log::info("OTP user ".$request->user_id. ' OTP '.$otp);

       if($request->has('email') && $request->email){
           $userapp = UserApp::where('email', $request->email)->first();
       }else{
           $userapp = UserApp::where('id', $request->user_id)->first();
       }

       if(empty($userapp)){
           return response()->json([
            'status' => false,
            'code' => 2014,
            'message' => 'User not found. Please try with valid email.'
           ]);
       }

       $userapp->otp = $otp;
       $userapp->update();

       Log::info("user detial ".json_encode($userapp));
       // send email notification
       $userapp->notify(new SendOtpNotification($userapp, $otp));

        return response()->json([
            'status' => true,
            'user' => $userapp,
            'code' => config('response.1018.code'),
            'message' => config('response.1018.message'),
        ]);
    }

    /**
     * verify OTP
     */
    public function verifyOtp(Request $request)
    {
        Log::info("verifyOtp req".json_encode($request->all()));
        $rules = [
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());
        if (count($errors) > 0)
        {
            return response()->json(['status' => false, 'status_code' => 1013, 'data' => $errors]);
        }

        if($request->has('email') && $request->email){
            $userapp = UserApp::where('email', $request->email)->first();
        }else{
            $userapp = UserApp::where('id', $request->user_id)->first();
        }
        Log::info("userapp OTP ".json_encode($userapp));
        if($userapp->otp == null || $request->otp != $userapp->otp){
            return response()->json([
                'status' => false,
                'code' => config('response.1019.code'),
                'message' => config('response.1019.message'),
            ]);
        }

        $userapp->otp = null;
        $userapp->status = 1;
        $userapp->update();

        return response()->json([
            'status' => true,
            'code' => config('response.1020.code'),
            'message' => config('response.1020.message'),
        ]);
    }

    /**
     * get user profile
     */
    public function userProfile(Request $request)
    {
        $profile = $request->user();

        $countsQuery = [
            'posts as posts_count',
            'activities as like_count' => function ($query) {
                $query->where('post_activities.type', config('constants.POST_ACTIVITY_LIKE'));
            },
            'activities as dislike_count' => function ($query) {
                $query->where('post_activities.type', config('constants.POST_ACTIVITY_DISLIKE'));
            },
            'activities as comment_count' => function ($query) {
                $query->where('post_activities.type', config('constants.POST_ACTIVITY_COMMENT'));
            },
            // 'followers as is_following' => function ($query) use ($profile) {
            //     $query->where('followables.user_apps_id', $profile->id);
            // },
            // 'following as following_count',
            // 'followers as followers_count'
        ];

        if($request->has('user_id') && $request->user_id){
            $postIds = Post::where('user_apps_id', $request->user_id)->pluck('id');
            $user = UserApp::where('id', $request->user_id)->withCount($countsQuery)->first();

            // check if current user follow requested user.
            $followStatus = DB::table('user_follower')->where(['following_id'=> $user->id, 'follower_id' => $profile->id])->first();
            $user->has_followed = ($followStatus && !empty($followStatus)) ? true : false;
        }else{
            $user = UserApp::where('id', $profile->id)->withCount($countsQuery)->first();
            $postIds = Post::where('user_apps_id', $profile->id)->pluck('id');
        }

        // get userpost ids
    //    $voterCount = DB::table('post_activities')->where('post_activities.type', config('constants.POST_ACTIVITY_LIKE'))
    //     ->whereIn('post_id', $postIds)->distinct('user_apps_id')->count();
        $userFollower = $user->followers()->get();
        $userFollowings = $user->followings()->get();
        $user->following_count = count($userFollowings);
        $user->followers_count = count($userFollower);
        $user->followers_list = $userFollower;
        $user->followings_list = $userFollowings;
        // $user->voter_count = $voterCount;

        // get user posts
        $posts = null;
        $postManagementController = new PostManagementController;
        if($request->has('user_id') && $request->user_id){
            $userPosts = $postManagementController->allPosts($request);
            if($userPosts->original['code'] == 1002){
                $posts = $userPosts->original['data'];
            }
        }else{
            $userPosts = $postManagementController->myposts($request);
            if($userPosts->original['code'] == 1009){
                $posts = $userPosts->original['data'];
            }
        }

        $userProfileType = config('constants.user_profile_type.1');

        // check user type
        if(count($posts)){
            if($request->has('user_id') && $request->user_id){
                $type = Post::where('user_apps_id', $request->user_id)
                ->select('category')
                ->groupBy('category')->OrderBy('category', 'ASC')->first();
            }else{
                $type = Post::where('user_apps_id', $profile->id)
                ->select('category')
                ->groupBy('category')->OrderBy('category', 'ASC')->first();
            }
            $userProfileType = config('constants.user_profile_type.'.$type->cate_name);
        }
        $user->user_profile_type = $userProfileType;
        return response()->json([
            'status' => true,
            'code' => 3001,
            'data' => $user,
            'posts' => $posts,
            'message' => 'Get user profile success',
        ]);
    }

    /**
     * update user password
     */
    public function updatePassword(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        $user = UserApp::where('email', $request->email)->first();
        if(empty($user)){
            return response()->json([
                'status' => false,
                'code' => 2012,
                'message' => 'User Not found'
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->update();
        return response()->json([
            'status' => true,
            'code' => 2013,
            'message' => 'Message Updated successfully.'
        ]);
    }

    public function searchUserTagFriends(Request $request)
    {
        $users = [];
        if($request->has('q')){
            $search = $request->q;
            $users = UserApp::select("id", "user_name")
            		->where('user_name', 'LIKE', "%$search%")
                    ->where('status', 1)
            		->get();
        }
        return response()->json($users);
    }

    public function saerchTags(Request $request)
    {
        $users = [];
        if($request->has('q')){
            $search = $request->q;
            $users = TagsTag::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($users);
    }
}
