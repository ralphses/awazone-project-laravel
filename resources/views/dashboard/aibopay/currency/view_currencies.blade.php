<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>


    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Currencies</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Full Table -->

            @if(!is_null($currencies))
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Custom Text here></h3>
                        <div class="block-options">
                            <a href="{{ route('currency.add') }}">
                                <button type="button" class="btn btn-alt-primary">
                                    New Currency
                                </button>
                            </a>
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
                                    <th style="width: 10%">Code</th>
                                    <th style="width: 25%">Official Name</th>
                                    <th style="width: 15%">Type</th>
                                    <th style="width: 20%">status</th>
                                    <th style="width: 30%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currencies as $id => $currency)
                                    <tr>
                                        <td class="text-left">
                                            {{ $currency->code }}
                                        </td>
                                        <td class="text-left">
                                            {{ $currency->official_name }}
                                        </td>
                                        <td>
                                            {{ $currency->type }}
                                        </td>

                                        <td>
                                            {{ $currency->active ? "Active" : "Inactive" }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href='{{ route("currency.actions", $currency->id) }}'>
                                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>

                                                <form
                                                    @if($currency->active)

                                                        action="{{ route('currency.actions', $currency->id) }}"
                                                        method="POST">

                                                        <input value="{{ 'deactivate' }}" type="text" hidden name="action">

                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Deactivate">
                                                            <i class="fa fa-cancel"></i>
                                                        </button>
                                                    @else
                                                        action="{{ route('currency.actions', $currency->id) }}"
                                                        method="POST">

                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Activate">
                                                            <i class="fa fa-cancel"></i>
                                                        </button>

                                                    @endif

                                                </form>

                                                <form

                                                    action="{{ route('currency.actions', $currency->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>

                                                </form>

                                            </div>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            @else
                <div class="block block-rounded">
                    <div class="block-content block-content-full flex-ce">
                        <div class="row text-center" style="justify-content: center">
                            <div class="col-md-10 py-3">
                                <div class="fs-1 fw-light text-primary-darker mb-1">
                                    No Currency Added Yet
                                </div>
                                <a class=" fs-sm fw-bold text-uppercase text-muted" href="{{ route('currency.add') }}">
                                    <button type="button" class="btn btn-alt-primary">
                                        Add New Currency
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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

</x-layout.dashboard-layout>
