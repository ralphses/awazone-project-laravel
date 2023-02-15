<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>

    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Add new Card</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content"  style="width: 70%; align-self: center" >
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action="{{ route('card.create') }}"
                  method="post"

            @method('POST')
            @csrf
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <!-- Regular -->
                    <h2 class="content-heading">Card Details</h2>

                    <div class="mb-4">
                        <label class="form-label" for="val-username">Bank name<span class="text-danger">*</span></label>
                        <select class="form-select" id="example-select" name="bank-name">
                            <option selected="">Select...</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank }}">{{ $bank }}</option>
                            @endforeach
                        </select>
                        @if($errors->any('bank-name'))
                            <p style="color: red; font-size: small">{{$errors->first('bank-name')}}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="val-username">Select Card Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="example-select" name="type">
                            <option selected="">Select...</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}">{{  $type }}</option>
                            @endforeach
                        </select>
                        @if($errors->any('type'))
                            <p style="color: red; font-size: small">{{$errors->first('type')}}</p>
                        @endif
                    </div>


                    <div class="mb-4">
                        <label class="form-label" for="val-username">Card Number <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="val-username" name="card-number" value="{{ old('card-number')}}">

                        @if($errors->any('card-number'))
                            <p style="color: red; font-size: small">{{$errors->first('card-number')}}</p>
                        @endif

                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="val-username">Expiry Month and Year<span class="text-danger">*</span></label>
                        <input type="month" class="form-control" id="val-username" name="expiry-month" value="{{ old('expiry-month')}}">

                        @if($errors->any('expiry-month'))
                            <p style="color: red; font-size: small">{{$errors->first('expiry-month')}}</p>
                        @endif

                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="val-username">Card PIN<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="val-username" name="card-pin" value="{{ old('card-pin') }}">

                        @if($errors->any('card-pin'))
                            <p style="color: red; font-size: small">{{ $errors->first('card-pin') }}</p>
                        @endif

                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="val-username">CVV<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="val-username" name="card-cvv" value="{{ old('card-cvv') }}">

                        @if($errors->any('card-cvv'))
                            <p style="color: red; font-size: small">{{ $errors->first('card-cvv') }}</p>
                        @endif

                    </div>

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7 offset-lg-4" style="justify-content: center">
                            <button type="submit" class="btn btn-primary" style="width: 70%">Add Card</button>
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
