<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>


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
        <div class="content"  style="width: 70%; align-self: center" >
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action="{{ route('role.update', ['id' => $role->id]) }}"
                  method="post"
                  enctype="multipart/form-data">

                @method('PATCH')
                @csrf
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <!-- Regular -->
                        <h2 class="content-heading">Role Details</h2>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">Role name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-username" name="name" value="{{ $role->name }}" placeholder="Enter role name">

                            @if($errors->any('name'))
                                <p style="color: red; font-size: small">{{$errors->first('name')}}</p>
                            @endif

                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-address">Role Description<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="val-address" name="description" rows="3" placeholder="Describe this role">{{ $role->description }}</textarea>
                            @if($errors->any('description'))
                                <p style="color: red; font-size: small">{{$errors->first('description')}}</p>
                            @endif
                        </div>

                        <h2 class="content-heading">Select authorities</h2>

                        @foreach($otherRoles as $key => $values)
                            <div class="row items-push">
                                <div class="col-lg-3">
                                    <h6 class="text-muted">{{ $key }}</h6>
                                </div>

                                <div class="col-lg-8 col-xl-5">

                                    @foreach($values as $value)

                                        <div class="mb-1">
                                            <div class="space-y-2">
                                                <div class="form-check">
                                                    <input class="form-check-input others" type="checkbox" value="{{ $value }}" id="example-checkbox-default1" name="{{ $value }}" @if(in_array($value, $role->abilities())) {{ 'checked' }} @endif>
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
