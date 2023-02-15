<x-layout.pay-layout>

    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('/assets/media/photos/photo9@2x.jpg');">
        <div class="row g-0 justify-content-center bg-black-75">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                <!-- Lock Block -->
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                    <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                        <!-- Header -->
                        <div class="mb-2 text-center">
                            <p class="text-red-600">Please enter
                                <strong>One Time Password</strong>
                                sent to your phone number to complete your transaction
                            </p>
                        </div>

                        <!-- END Header -->

                        <!-- Lock Form -->
                        <!-- jQuery Validation (.js-validation-lock class is initialized in js/pages/op_auth_lock.min.js which was auto compiled from _js/pages/op_auth_lock.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-lock" action="{{ route('user.pay.otp') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <input type="password" class="form-control otp" id="lock-password" name="otp" placeholder="One time password..">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <p style="display: none; color: red; font-size: small" id="otp-length-error">{{ session()->get('card-error') ?? "OTP cannot be more than 6 digits" }}</p>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-hero btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <!-- END Lock Form -->
                    </div>
                </div>
                <!-- END Lock Block -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <x-layout.dashboardLayout.dashboard-footer></x-layout.dashboardLayout.dashboard-footer>


    <!-- jQuery (required for Select2 + jQuery Validation plugins) -->
    <script src="/assets/dashboard/assets/js/lib/jquery.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="/assets/dashboard/assets/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/dashboard/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/assets/dashboard/assets/js/plugins/jquery-validation/additional-methods.js"></script>

    <!-- Page JS Helpers (Select2 plugin) -->
    <script>Dashmix.helpersOnLoad(['jq-select2']);</script>

    <script>
        let otpErrorField = document.getElementById('otp-length-error');
        let otpField = document.querySelector('.otp');

        otpField.addEventListener('input', () => {
            if(otpField.value.length > 6) {
                otpErrorField.style.display = 'block';
                otpField.value = otpField.value.substring(0, 6);
            }
        });
    </script>


    <!-- Page JS Code -->
    <script src="/assets/dashboard/assets/js/pages/be_forms_validation.min.js"></script>

</x-layout.pay-layout>
