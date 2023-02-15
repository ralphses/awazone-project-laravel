<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>


    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">User Roles</h1>
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
                       <a href="{{ route('role.create') }}">
                           <button type="button" class="btn btn-alt-primary">
                               Create New Role
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
                                <th style="width: 15%">Role name</th>
                                <th style="width: 25%">Description</th>
                                <th style="width: 20%">Authorities</th>
                                <th style="width: 20%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                            <tr>
                                <td class="text-left">
                                    {{ $key }}
                                </td>
                                <td class="text-left">
                                    {{ $role['description'] }}
                                </td>
                                <td>
                                    @for($count = 0; $count < count($role['authorities']); $count++)
                                        @if($count >3)
                                            <a href="{{ route('role.view', $role['id']) }}"><p style="padding: 0">...view more</p></a>
                                        @break($count > 3)

                                        @endif
                                            <p style="padding: 0">{{ $role['authorities'][$count] }}</p>
                                    @endfor
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">

                                        <form action="{{ route('role.view', $role['id']) }}" method="GET">

                                            <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>

                                        </form>

                                        <form action="{{ route('role.delete', $role['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>

                                        </form>

                                        <a href="{{ route('user.all', $role['id']) }}">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="View users">
                                                <i class="fa fa-user"></i>
                                            </button>
                                        </a>

                                    </div>
                                </td>
                            </tr>

                            @endforeach

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

</x-layout.dashboard-layout>
