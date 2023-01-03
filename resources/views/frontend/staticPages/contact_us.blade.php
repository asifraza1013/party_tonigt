@extends('frontend.layouts.layouts', ['title' => __('Contact us')])
@section('content')
    <div class="timeline-cover" style="background: url('{{ asset('frontend/images/Rectangle 158.png') }}') no-repeat;">
        <div class="google-maps">
            <div id="map" class="map contact-map"></div>
        </div>
        <div id="page-contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="contact-us">
                            <div class="row">
                                <div class="col-md-8 col-sm-7">
                                    <h4 class="grey">Leave a Message</h4>
                                    <form class="contact-form" action="{{ route('submit.contact.us') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <i class="icon ion-person"></i>
                                            <input id="contact-name" type="text" name="name" class="form-control"
                                                placeholder="Enter your name *" required="required"
                                                data-error="Name is required.">
                                        </div>
                                        <div class="form-group">
                                            <i class="icon ion-email"></i>
                                            <input id="contact-email" type="text" name="email" class="form-control"
                                                placeholder="Enter your email *" required="required"
                                                data-error="Email is required.">
                                        </div>
                                        <div class="form-group">
                                            <i class="icon ion-android-call"></i>
                                            <input id="contact-phone" type="text" name="phone" class="form-control"
                                                placeholder="Enter your phone *" required="required"
                                                data-error="Phone is required.">
                                        </div>
                                        <div class="form-group">
                                            <textarea id="form-message" name="message" class="form-control" placeholder="Leave a message for us *" rows="4"
                                                required="required" data-error="Please,leave us a message."></textarea>
                                        </div>
                                        <button type="submit" class="btn-primary">Send a Message</button>
                                    </form>
                                </div>
                                <div class="col-md-4 col-sm-5">
                                    <h4 class="grey">Reach Us</h4>
                                    <div class="reach"><span class="phone-icon"><i
                                                class="icon ion-android-call"></i></span>
                                        <p>9549370181</p>
                                    </div>
                                    <div class="reach"><span class="phone-icon"><i class="icon ion-email"></i></span>
                                        <p>info@partytonight.us</p>
                                    </div>
                                    <div class="reach"><span class="phone-icon"><i
                                                class="icon ion-ios-location"></i></span>
                                        <p>
                                            3750 NW 28th St, Unit 207
                                            Miami , FL 33142
                                            United States</p>
                                    </div>
                                    <ul class="list-inline social-icons">
                                        <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                                        <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                                        <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                                        <li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
                                        <li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
