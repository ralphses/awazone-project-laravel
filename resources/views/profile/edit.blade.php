<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>

    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">User Information</h1>

                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action="{{route('profile.update', $user->id)}}"
                  method="post"
                  enctype="multipart/form-data">

                @method('PATCH')
                @csrf
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <!-- Regular -->
                        <h2 class="content-heading">User Details</h2>
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <p class="text-muted">
                                    Username, email and password validation made easy for your login/register forms
                                </p>
                            </div>

                            <div class="col-lg-8 col-xl-5">

                                <h6 style="font-size: medium"><strong>Referral link: <br></strong> {{ route('register') . '?referralCode=' . $user->referral_code }}</h6>
{{--                                <h6 style="font-size: medium"><strong>Referral link: <br></strong> <?php echo route('register') . '?referralCode=' . $user->referral_code ? : ></h6>--}}
                                <div class="mb-4">
                                    <label class="form-label" for="val-username">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="val-username" name="val-name" value="{{$user->name}}" placeholder="Enter your name" disabled>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" value="{{$user->email}}" id="val-email" name="val-email" placeholder="Your valid email.." disabled>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="val-user-name">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('username', $user->username) }}" id="val-user-name" name="username" placeholder="Your valid username..">

                                    @if($errors->any('username'))
                                        <p style="color: red; font-size: small">{{$errors->first('username')}}</p>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="dob">Date of birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}" id="dob" name="date_of_birth" placeholder="Your valid username..">

                                    @if($errors->any('date_of_birth'))
                                        <p style="color: red; font-size: small">{{$errors->first('date_of_birth')}}</p>
                                    @endif
                                </div>

                                <img class="img-avatar" src="{{str_replace('C:\Users\Ralph\Desktop\workspace\awazone-project\public', '', $user->image_path)}}" alt="">

                                <div class="mb-4">
                                    <label class="form-label" for="example-file-input">Choose new image</label>
                                    <input class="form-control" type="file" name="image_path" id="example-file-input">
                                </div>

                            </div>

                        </div>
                        <!-- END Regular -->

                        <h2 class="content-heading">Contact Details</h2>
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <p class="text-muted">
                                    Username, email and password validation made easy for your login/register forms
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="mb-4">
                                    <label class="form-label" for="val-phone">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('phone', $user->userContact->phone ?? "") }}" id="val-phone" name="phone" placeholder="e.g +234701111111">
                                    @if($errors->any('phone'))
                                        <p style="color: red; font-size: small">{{$errors->first('phone')}}</p>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="val-zip">Zip/Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('zip_or_postal_code', $user->userContact->zip_or_postal_code ?? 0) }}" id="val-zip" name="zip_or_postal_code" placeholder="e.g 52311">
                                    @if($errors->any('zip_or_postal_code'))
                                        <p style="color: red; font-size: small">{{$errors->first('zip_or_postal_code')}}</p>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="val-address">Address line <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="val-address" name="address" rows="5" placeholder="Where do you live?">{{ old('address', $user->userContact->address ?? "") }}</textarea>
                                    @if($errors->any('address'))
                                        <p style="color: red; font-size: small">{{$errors->first('address')}}</p>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="province">Province/LGA/County <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{old('province', $user->userContact->province ?? "")}}" id="province" name="province" placeholder="e.g Doma">
                                    @if($errors->any('province'))
                                        <p style="color: red; font-size: small">{{$errors->first('province')}}</p>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="state">State<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('state', $user->userContact->state ?? "") }}" id="state" name="state" placeholder="e.g Texas">
                                    @if($errors->any('state'))
                                        <p style="color: red; font-size: small">{{$errors->first('state')}}</p>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="country">Country<span class="text-danger">*</span></label>
                                    <select class="form-select" id="country" name="country">
                                        <option value="{{ old('country', $user->userContact->country ?? "")}}">{{ old('country', $user->userContact->country ?? "Please select")}}</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Ghana">Ghana</option>
                                    </select>
                                    @if($errors->any('country'))
                                        <p style="color: red; font-size: small">{{$errors->first('country')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <h2 class="content-heading">Aibopay Account Details</h2>
                        <div class="row items-push">
                            <div class="col-lg-4">
                                <p class="text-muted">
                                    Username, email and password validation made easy for your login/register forms
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">

                                <div class="mb-4">
                                    <label class="form-label" for="mainCurrency">Main Currency<span class="text-danger">*</span></label>
                                    <select class="form-select" id="mainCurrency" name="mainCurrency">
                                        <option value="{{ old('mainCurrency', $user->main_currency ?? "")}}">{{ old('mainCurrency', $user->main_currency ?? "Please select")}}</option>
                                        @foreach($currencies as $key => $currency)
                                            <option value="{{ $key }}">{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->any('mainCurrency'))
                                        <p style="color: red; font-size: small">{{$errors->first('mainCurrency')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <!-- Submit -->
                        <div class="row items-push">
                            <div class="col-lg-7 offset-lg-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <!-- END Submit -->
                    </div>
                </div>
            </form>
            <!-- jQuery Validation -->

            <!-- Terms Modal -->
            <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Terms &amp; Conditions</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Terms Modal -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->


    <x-layout.dashboardLayout.dashboard-footer></x-layout.dashboardLayout.dashboard-footer>


    <!-- jQuery (required for Select2 + jQuery Validation plugins) -->
    <script src="/assets/dashboard/assets/js/lib/jquery.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="/assets/dashboard/assets/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/dashboard/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/assets/dashboard/assets/js/plugins/jquery-validation/additional-methods.js"></script>

    <!-- Page JS Helpers (Select2 plugin) -->
    <script>Dashmix.helpersOnLoad(['jq-select2']);</script>

    <!-- Page JS Code -->
    <script src="/assets/dashboard/assets/js/pages/be_forms_validation.min.js"></script>

</x-layout.dashboard-layout>






{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Profile') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-profile-information-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-password-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.delete-user-form')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}
