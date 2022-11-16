@extends('frontend.layouts.layouts', ['title' => __('Landing Page')])

@section('content')
<div id="lp-register">
    <div class="container wrapper">
        <div class="row">
            <div class="col-sm-5">
            <div class="intro-texts">
                <h1 class="text-white">Party Tonight !!!</h1>
                <p> Please Verify your self. <br> We already sent and OTP on your email. Please check and verify. Thank you</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login Screen</a>
            </div>
        </div>
            <div class="col-sm-6 col-sm-offset-1">
                <div class="reg-form-container">
                    <div class="card-bodyd">
                        <div class="form-group">
                            <h5>OTP is already sent to your <strong>({{ $user->email }})</strong> email. Pleaes check that out. </h5>
                        </div>
                        <form action="{{ route('client.verification.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">OTP</label>
                                <input type="hidden" name="user" value="{{ Crypt::encrypt($user->id) }}">
                                <input type="text" name="otp" value="" placeholder="Please enter You OTP" class="form-control">

                               <p>if you Didn't get OTP. <a href="{{ route('client.verification.screen', [Crypt::encrypt($user->id), true]) }}" class="mt-3">Resend</a></p>
                            </div>
                            <button class="btn btn-success btn-sm btn-block" type="submit">Verify Now!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
