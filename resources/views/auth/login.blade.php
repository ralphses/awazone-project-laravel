
<x-auth.auth-layout>



<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('/assets/dashboard/assets/media/photos/photo19@2x.jpg');">
            <div class="row g-0 justify-content-center bg-primary-dark-op">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Sign In Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="link-fx fw-bold fs-1" href="index.html">
                                    <span class="text-dark">Dash</span><span class="text-primary">mix</span>
                                </a>
                                <p class="text-uppercase fw-bold fs-sm text-muted">Sign In</p>
                            </div>
                            <!-- END Header -->

                            <!-- Sign In Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                    </div>
                                    @if($errors->any('email'))
                                        <p style="color: red; font-size: small">{{$errors->first('email')}}</p>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="password" class="form-control" id="login-password" name="password" placeholder="Password">
                                        <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                    </div>
                                    @if($errors->any('password'))
                                        <p style="color: red; font-size: small">{{$errors->first('password')}}</p>
                                    @endif
                                </div>
                                <div class="d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-start mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="login-remember-me" name="remember" checked>
                                        <label class="form-check-label" for="login-remember-me">Remember Me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="fw-semibold fs-sm py-1">
                                            <a href="{{  route('password.request') }}">Forgot Password?</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-hero btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign In
                                    </button>
                                </div>
                                <div class="fw-semibold fs-sm py-1">
                                    <a href="{{ route('register')}}"><p class="text-uppercase text-center fw-bold fs-sm text-muted">Create New Account</p>
                                    </a>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>

                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

</x-auth.auth-layout>
