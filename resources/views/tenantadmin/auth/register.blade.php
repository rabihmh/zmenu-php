@extends('layouts.dashboard-auth-layout')
@section('title')
    {{config('app.name')}} - Register
@endsection
@section('content')

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form action="{{route('register')}}" method="POST" class="user">
                            @csrf
                            <div class="form-group ">
                                <x-input-a name="name" placeholder="Name" :reuired="true"/>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <x-input-a type="email" name="email" placeholder="Email" :reuired="true"/>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <x-input-a name="phone" placeholder="Phone Number" :reuired="true"/>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <x-input-a name="password" placeholder="Password" :reuired="true" type="password"/>
                                </div>
                                <div class="col-sm-6">
                                    <x-input-a name="password_confirmation" placeholder="Repeat Password" :reuired="true" type="password"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <hr>
                            <a href="#" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="#" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="#">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

