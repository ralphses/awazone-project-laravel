<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>


    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">All Users</h1>
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
                        <select class="form-select" id="example-select" name="example-select">
                            <option selected="">Sort by...</option>
                            <option value="name|asc">Name - ASC</option>
                            <option value="name|desc">Name - DSC</option>
                            <option value="email|asc">Email - ASC</option>
                            <option value="email|desc">Email - DSC</option>
                            <option value="created_at|asc">Date created - ASC</option>
                            <option value="created_at|desc">Date created - DSC</option>
                            <option value="email_verified_at|asc">Verified - ASC</option>
                            <option value="email_verified_at|desc">Verified - DSC</option>
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
                                <th style="width: 15%">Name</th>
                                <th style="width: 25%">Role</th>
                                <th style="width: 20%">Status</th>
                                <th style="width: 20%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-left">
                                        {{ $user->name }}
                                    </td>
                                    <td class="text-left">
                                        {{ $user->userAbility->name }}
                                    </td>
                                    <td>
                                        @if($user->email_verified_at)
                                            {{ 'verified |' }}
                                        @else
                                        {{ 'not verified |' }}
                                        @endif

                                        @if($user->is_locked)
                                                {{ "Unlocked" }}

                                            @else
                                                {{ "Suspended" }}
                                            @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">

                                            @if($user->is_locked)
                                            <form action="{{ route('user.status', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <input name="locked" value="{{ $user->is_locked }}" hidden>

                                                <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Deactivate">
                                                    <i class="fa fa-person-circle-xmark"></i>
                                                </button>

                                            </form>
                                            @else
                                                <form action="{{ route('user.status', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input name="locked" value="{{ $user->is_locked }}" hidden>


                                                    <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Activate">
                                                        <i class="fa fa-person-circle-check"></i>
                                                    </button>

                                                </form>
                                            @endif

                                            <form action="{{ route('profile.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>

                                            </form>
                                                <a href="{{ route('role.assign', $user->id) }}">
                                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Assign role">
                                                        <i class="fa fa-tasks"></i>
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

    <script>

        const selectedSort = document.getElementById("example-select");
        const loc = window.location.href;

        selectedSort.addEventListener('change', () => {
            const value = selectedSort.options[selectedSort.selectedIndex].value.split("|");
            window.location.href = loc.substring(0, loc.indexOf('?')) + "?sort=" + value[0] + "&order=" + value[1];

        });

    </script>

</x-layout.dashboard-layout>
