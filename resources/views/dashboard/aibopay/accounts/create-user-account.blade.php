<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>

    {{--    {{$abilities['User.abilities'][0]}}--}}


    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create new Account</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content"  style="width: 70%; align-self: center" >
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action="{{ route('user.aibopay-accounts.store') }}"
                  method="post"

                @method('POST')
                @csrf
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <!-- Regular -->
                        <h2 class="content-heading">Account Details</h2>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">Account name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-username" name="full-name" value="{{ \Illuminate\Support\Facades\Auth::user()->name}}">

                            @if($errors->any('full-name'))
                                <p style="color: red; font-size: small">{{$errors->first('full-name')}}</p>
                            @endif

                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">Select Account Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="example-select" name="type">
                                <option selected="">Select...</option>
                                @foreach($accountTypes as $accountType)
                                    <option value="{{ $accountType }}">{{  $accountType }}</option>
                                @endforeach
                            </select>
                            @if($errors->any('type'))
                                <p style="color: red; font-size: small">{{$errors->first('type')}}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">Select Currency <span class="text-danger">*</span></label>
                            <select class="form-select" id="example-select" name="currency">
                                <option selected="">Select...</option>
                                @foreach($currencies as $key => $currency)
                                    <option value="{{ $currency }}">{{ $currency }}</option>
                                @endforeach
                            </select>
                            @if($errors->any('currency'))
                                <p style="color: red; font-size: small">{{$errors->first('currency')}}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">BVN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-username" name="bvn" value="{{ \Illuminate\Support\Facades\Auth::user()->monnifyAccount->bvn ?? old('bvn') }}">

                            @if($errors->any('bvn'))
                                <p style="color: red; font-size: small">{{$errors->first('bvn')}}</p>
                            @endif

                        </div>

                        <!-- Submit -->
                        <div class="row items-push">
                            <div class="col-lg-7 offset-lg-4" style="justify-content: center">
                                <button type="submit" class="btn btn-primary" style="width: 70%">Create Account</button>
                            </div>
                        </div>
                        <!-- END Submit -->
                    </div>
                </div>
            </form>
            <!-- jQuery Validation -->

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
