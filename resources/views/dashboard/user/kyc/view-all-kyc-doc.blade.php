<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>


    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Users' KYC Documents</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Full Table -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Custom Text here></h3>
                    <div class="block-options">
                        <select class="form-select" id="sorter" name="example-select">
                            <option selected="">Sort by...</option>
                            <option value="document_type|asc">Type - ASC</option>
                            <option value="document_type|desc">Type - DSC</option>
                            <option value="status|asc">Status - ASC</option>
                            <option value="status|desc">Status - DSC</option>
                            <option value="created_at|asc">Date created - ASC</option>
                            <option value="created_at|desc">Date created - DSC</option>
                            <option value="verified_at|asc">Date verified - ASC</option>
                            <option value="verified_at|desc">Date verified - DSC</option>
                        </select>
                    </div>
                </div>
                <div class="block-content">
                    <p>
                        Optional Text here
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th style="width: 20%">Type</th>
                                <th style="width: 15%">User name</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 15%">Date created</th>
                                <th style="width: 15%">Date verified</th>
                                <th style="width: 25%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($docs as $doc)
                                <tr>

                                    <td class="text-left">
                                        {{ $doc->document_type }}
                                    </td>

                                    <td class="text-left">
                                        {{ $doc->user->name }}
                                    </td>

                                    <td class="text-left">
                                        @foreach(\App\Models\Utility::KYC_STATUS as $key => $value)
                                            @if($value == $doc->status)
                                                {{ $key }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="text-left">
                                        {{ $doc->created_at }}
                                    </td>

                                    <td class="text-left">

                                        @if($doc->verified_at)
                                            {{ $doc->verified_at }}
                                        @else
                                            {{ 'Not verified' }}
                                        @endif
                                    </td>

                                    <td class="text-center">
                                            <div class="btn-group">

                                                <form action="{{ route('kyc.approve', $doc->id) }}", method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Approve">
                                                        <i class="fa fa-circle-check"></i>
                                                    </button>

                                                </form>
                                            </div>


                                        <div class="btn-group">

                                            <form action="{{ route('kyc.approve', $doc->id) }}", method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-circle-xmark"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="btn-group">
                                            <a href="{{ route('kyc.approve', $doc->id) }}">
                                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>

                                        </div>

                                        <div class="btn-group">
                                            <form action="{{ route('kyc.approve', $doc->id) }}", method="POST">
                                                @csrf
                                                @method('PUT')

                                                <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Suspend">
                                                    <i class="fa fa-arrow-turn-down"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- END Full Table -->
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

    <script>

        const selectedSort = document.getElementById("example-select");
        const loc = window.location.href;

        selectedSort.addEventListener('change', () => {
            const value = selectedSort.options[selectedSort.selectedIndex].value.split("|");
            window.location.href = loc.substring(0, loc.indexOf('?')) + "?sort=" + value[0] + "&order=" + value[1];

        });

    </script>

</x-layout.dashboard-layout>
