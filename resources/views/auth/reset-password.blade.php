
<x-auth.auth-layout>


<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('/assets/dashboard/assets/media/photos/photo16@2x.jpg');">
            <div class="row g-0 justify-content-center bg-black-75">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Reminder Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="link-fx fw-bold fs-1" href="/">
                                    <span class="text-dark">Dash</span><span class="text-primary">mix</span>
                                </a>
                                <p class="text-uppercase fw-bold fs-sm text-muted">Password Reset</p>
                            </div>
                            <!-- END Header -->

                            <!-- Reminder Form -->
                            <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _js/pages/op_auth_reminder.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-reminder" action="{{ route('password.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="email" class="form-control" id="reminder-credential" name="email" placeholder="Email" value="{{ old('email', $request->email) }}">
                                        <span class="input-group-text"><i class="fa fa-user-circle"></i></span>

                                        @if($errors->any('email'))
                                            <p style="color: red; font-size: small">{{$errors->first('email')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="password" class="form-control" id="reminder-credential" name="password" placeholder="New Password">
                                        <span class="input-group-text"><i class="fa fa-lock-circle"></i></span>

                                        @if($errors->any('password'))
                                            <p style="color: red; font-size: small">{{$errors->first('password')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="password" class="form-control" id="reminder-credential" name="password_confirmation" placeholder="Confirm Password">
                                        <span class="input-group-text"><i class="fa fa-lock-circle"></i></span>

                                        @if($errors->any('password_confirmation'))
                                            <p style="color: red; font-size: small">{{$errors->first('password_confirmation')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-hero btn-primary">
                                        <i class="fa fa-fw fa-reply opacity-50 me-1"></i> Reset Password
                                    </button>
                                </div>
                            </form>
                            <!-- END Reminder Form -->
                        </div>
                    </div>
                    <!-- END Reminder Block -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

</x-auth.auth-layout>
