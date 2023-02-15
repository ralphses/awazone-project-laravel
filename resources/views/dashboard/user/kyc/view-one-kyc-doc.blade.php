<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>

    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">KYC Document</h1>

                    @can('update', \App\Models\UserKycDoc::class)

                    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
{{--                        <form action="{{ route('kyc.approve', $doc->id) }}" method="POST">--}}
                            @csrf
{{--                            @method('DELETE')--}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </nav>


                    @if($doc->status == 0)

                        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <form action="{{ route('kyc.approve', $doc->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-hero btn-warning">Suspend</button>
                            </form>
                        </nav>
                    @else
                        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <form action="{{ route('kyc.approve', $doc->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-hero btn-success">Approve</button>
                            </form>
                        </nav>

                    @endif

                    @endcan

                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded block-bordered">
                <div class="block-content">
{{--                    <form action="be_pages_projects_create.html" method="POST">--}}
                        <!-- Vital Info -->
                        <h2 class="content-heading pt-0">Document Details</h2>
                        <div class="row push">
                            <div class="col-lg-4">
                                <p class="text-muted">
                                    Some vital information about your new project
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="mb-4">
                                    <label class="form-label" for="dm-project-new-name">
                                        Holder's name
                                    </label>
                                    <input type="text" class="form-control" id="dm-project-new-name" value="{{ $doc->user->name }}" name="dm-project-new-name" placeholder="eg: example.com" disabled>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="dm-project-new-name">
                                        Document type
                                    </label>
                                    <input type="text" class="form-control" id="dm-project-new-name" value="{{ $doc->document_type }}" name="dm-project-new-name" placeholder="eg: example.com" disabled>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="dm-project-new-name">
                                        Date uploaded
                                    </label>
                                    <input type="text" class="form-control" id="dm-project-new-name" value="{{ $doc->created_at }}" name="dm-project-new-name" placeholder="eg: example.com" disabled>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="dm-project-new-name">
                                        Date approved
                                    </label>
                                    <input type="text" class="form-control" id="dm-project-new-name" value="{{ $doc->verified_at ?? "Not approved yet" }}" name="dm-project-new-name" placeholder="eg: example.com" disabled>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="dm-project-new-name">
                                       Status
                                    </label>
                                    <input type="text" class="form-control" id="dm-project-new-name"
                                           @if($doc->status === 1)
                                               value="{{ 'in-active' }}"
                                            @elseif($doc->status === 0)
                                               value="{{ 'active' }}"
                                           @else
                                               value="{{ 'Suspended' }}"
                                           @endif
                                           name="dm-project-new-name" placeholder="eg: example.com" disabled>
                                </div>

                            </div>
                        </div>
                        <!-- END Vital Info -->

                        <!-- Optional Info -->
                        <h2 class="content-heading pt-0">Document Image</h2>
                        <div class="row push">
                            <div class="col-lg-8 col-xl-12" style="alignment: center">
                                <img src="{{ $doc->image_path }}" style="width: 100%;">
                            </div>
                        </div>
                        <!-- END Optional Info -->

                        <!-- People -->

                        <!-- END Submit -->
{{--                    </form>--}}
                </div>
            </div>
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

