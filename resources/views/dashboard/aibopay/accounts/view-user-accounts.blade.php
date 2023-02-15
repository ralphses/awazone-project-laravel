<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>


    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Aibopay Accounts</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Full Table -->

            @if($accounts != null)
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Custom Text here></h3>
                    <div class="block-options">
                        <a href="{{ route('user.aibopay-accounts.create') }}">
                            <button type="button" class="btn btn-alt-primary">
                                Create New Account
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
                                <th style="width: 15%">Account name</th>
                                <th style="width: 25%">Account number</th>
                                <th style="width: 20%">status</th>
                                <th style="width: 20%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td class="text-left">
                                        {{ $account->accountName }}
                                    </td>
                                    <td class="text-left">
                                        {{ $account->accountNumber }}
                                    </td>
                                    <td>
                                        {{ $account->status }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('user.aibopay-accounts.actions', $account->id) }}">
                                                <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>

                                            <form
                                                @if($account->status === "INACTIVE")
                                                    action="{{ route('user.aibopay-accounts.actions', $account->id) }}"
                                                    method="POST">

                                                    <input value="{{ 'active' }}" type="text" hidden name="action">

                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Activate">
                                                        <i class="fa fa-cancel"></i>
                                                    </button>
                                                @else
                                                    action="{{ route('user.aibopay-accounts.actions', $account->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Deactivate">
                                                        <i class="fa fa-cancel"></i>
                                                    </button>

                                                @endif

                                            </form>

                                            <form
                                                action="{{ route('user.aibopay-accounts.actions', $account->id) }}"
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
                                    You do not have any active Aibipay Account
                                </div>
                                <a class=" fs-sm fw-bold text-uppercase text-muted" href="{{ route('user.aibopay-accounts.create') }}">
                                    <button type="button" class="btn btn-alt-primary">
                                        Create New Account
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
