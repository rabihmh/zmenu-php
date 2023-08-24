@extends('layouts.master2')
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}"
          rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{URL::asset('assets/img/media/login.png')}}"
                             class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex">
                                        <h1>Register</h1>
                                    </div>
                                    <div class="main-signup-header">
                                        <form action="{{route('register')}}" method="POST">
                                            @csrf
                                            <x-input-a name="name" placeholder="Enter your name" label="Name" required/>
                                            <x-input-a type="email" name="email" placeholder="Enter your email"
                                                       label="Email" required/>
                                            <x-input-a name="phone"
                                                       placeholder="Enter phone number" label="Phone Number"
                                                       required/>

                                            <x-input-a type="password" name="password" placeholder="Enter your password"
                                                       label="Password" required/>
                                            <x-input-a type="password" name="password_confirmation"
                                                       placeholder="Confirm Password" label="Confirm Password"
                                                       required/>

                                            <button class="btn btn-main-primary btn-block">Create Account</button>
                                        </form>
                                        <div class="main-signup-footer mt-5">
                                            <p>Already have an account? <a href="{{route('login')}}">Sign
                                                    In</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
@endsection
