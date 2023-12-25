@extends('layouts.dashboard-auth-layout')
@section('title')
    {{config('app.name')}} - Reset Password
@endsection
@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Reset Your Password?</h1>
                                </div>
                                <form class="user" action="{{route('password.update')}}" method="POST">
                                    @csrf
                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="form-group">
                                        <input class="form-control form-control-user" name="email" type="email"
                                               placeholder="Enter Email..." value="{{$request->email}}">
                                        @error('email')
                                        <span class="text-danger mt-2 ml-2">{{ $message }}</span>

                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-input-a name="password" type="password" placeholder="Enter Password..."/>
                                    </div>
                                    <div class="form-group">
                                        <x-input-a name="password_confirmation" type="password"
                                                   placeholder="Repeat Password..."/>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

{{--<form method="POST" action="{{ route('password.update') }}">--}}
{{--    @csrf--}}

{{--    <!-- Password Reset Token -->--}}
{{--    <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--    <!-- Email Address -->--}}
{{--    <div>--}}

{{--        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"--}}
{{--                      :value="old('email', $request->email)" required autofocus/>--}}

{{--        <x-input-error :messages="$errors->get('email')" class="mt-2"/>--}}
{{--    </div>--}}

{{--    <!-- Password -->--}}
{{--    <div class="mt-4">--}}

{{--        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required/>--}}

{{--        <x-input-error :messages="$errors->get('password')" class="mt-2"/>--}}
{{--    </div>--}}

{{--    <!-- Confirm Password -->--}}
{{--    <div class="mt-4">--}}

{{--        <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                      type="password"--}}
{{--                      name="password_confirmation" required/>--}}

{{--        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>--}}
{{--    </div>--}}

{{--    <div class="flex items-center justify-end mt-4">--}}
{{--        <x-primary-button>--}}
{{--            {{ __('Reset Password') }}--}}
{{--        </x-primary-button>--}}
{{--    </div>--}}
{{--</form>--}}
