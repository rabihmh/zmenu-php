<h1>Admin Login</h1>
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
            <div class="row wd-100p mx-auto text-center">
                <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                    <img src="{{asset('Front/images/icons/logo-mobile.png')}}"
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
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2>Welcome back!</h2>
                                        <h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
                                        <form action="{{route('login')}}" method="POST">
                                            @csrf
                                            {{--                                                <x-input-a name="{{Config::get('fortify.username')}}"--}}
                                            {{--                                                           label="Email,username or phone" required/>--}}
                                            {{--                                                <x-input-a type="password" name="password"
                                            label="password" required/>--}}
                                            <label>Remember</label>
                                            <input id="remember_me" type="checkbox" name="remember">

                                            <button class="btn btn-main-primary btn-block">Sign In</button>
                                        </form>
                                        <div class="main-signin-footer mt-5">
                                            <p><a href="">?Forgot password</a></p>
                                        </div>
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

