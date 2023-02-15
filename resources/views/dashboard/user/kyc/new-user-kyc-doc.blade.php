<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>


    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">New KYC Document</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content"  style="width: 70%; align-self: center" >
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action=" {{ route('kyc.store') }}"
                  method="post"
                  enctype="multipart/form-data">

                @csrf
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <!-- Regular -->
                        <h2 class="content-heading">KYC document details</h2>

                        <div class="mb-4">
                            <label class="form-label" for="doc_type">Select ID Type<span class="text-danger">*</span></label>
                            <select class="form-select" id="doc_type" name="doc-type">
                                <option selected="">Select...</option>
                                @foreach($doc_type as $key => $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach

                            </select>
                            @if($errors->any('doc-type'))
                                <p style="color: red; font-size: small">{{$errors->first('doc-type')}}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="example-file-input">Upload Scanned ID</label>
                            <input class="form-control" type="file" name="image" id="example-file-input">

                            @if($errors->any('image'))
                                <p style="color: red; font-size: small">{{$errors->first('image')}}</p>
                            @endif
                        </div>

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
