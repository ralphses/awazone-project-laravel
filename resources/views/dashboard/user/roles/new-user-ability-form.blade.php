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
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Create new role</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content"  style="width: 85%; align-self: center" >
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action="{{ route('user-abilities') }}"
                  method="post"
                  enctype="multipart/form-data">

                @method('POST')
                @csrf
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <!-- Regular -->
                        <h2 class="content-heading">Role Details</h2>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">Role name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-username" name="name" value="{{ old('name') }}" placeholder="Enter role name">

                            @if($errors->any('name'))
                                <p style="color: red; font-size: small">{{$errors->first('name')}}</p>
                            @endif

                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-address">Role Description<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="val-address" name="description" rows="3" placeholder="Describe this role">{{ old('description') }}</textarea>
                            @if($errors->any('description'))
                                <p style="color: red; font-size: small">{{$errors->first('description')}}</p>
                            @endif
                        </div>

                        <h2 class="content-heading">Select authorities</h2>

                    @foreach($abilities as $key => $values)
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <h6 class="text-muted">{{ $key }}</h6>
                            </div>

                            <div class="col-lg-8 col-xl-5">

                                @foreach($values as $value)

                                    <div class="mb-1">
                                        <div class="space-y-2">
                                            <div class="form-check">
                                                <input class="form-check-input others" type="checkbox" value="{{ $value }}" id="example-checkbox-default1" name="{{ $value }}">
                                                <label class="form-check-label" for="example-checkbox-default1">{{$value}}</label>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>

                        </div>
                        <!-- END Regular -->

                        @endforeach


                        <!-- Submit -->
                        <div class="row items-push">
                            <div class="col-lg-7 offset-lg-4">
                                <button type="submit" class="btn btn-primary">Save</button>
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
