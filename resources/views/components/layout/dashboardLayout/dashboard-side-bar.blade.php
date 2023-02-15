<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header (mini Sidebar mode) -->
    <div class="smini-visible-block">
        <div class="content-header bg-header-dark">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="/">
                D<span class="opacity-75">x</span>
            </a>
            <!-- END Logo -->
        </div>
    </div>
    <!-- END Side Header (mini Sidebar mode) -->

    <!-- Side Header (normal Sidebar mode) -->
    <div class="smini-hidden">
        <div class="content-header justify-content-lg-center bg-header-dark">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="/">
                Ai<span class="opacity-75">bo</span><span class="fw-normal">pay</span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div class="d-lg-none">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times-circle"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header (normal Sidebar mode) -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Actions -->
        <div class="content-side content-side-full text-center bg-body-light">
            <div class="smini-hide">
                <img class="img-avatar" src="{{ \Illuminate\Support\Facades\Auth::user()->image_path }}" alt="">
                <div class="mt-3 fw-semibold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
                <a class="link-fx text-muted" href="javascript:void(0)">$ 49.680,00</a>
            </div>
        </div>
        <!-- END Side Actions -->

        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link active" href="{{ route('account') }}">
                        <i class="nav-main-link-icon fa fa-rocket"></i>
                        <span class="nav-main-link-name">Overview</span>
                    </a>
                </li>
                <li class="nav-main-heading">Manage</li>

                @can('viewAny', \App\Models\User::class)
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-user-circle"></i>
                        <span class="nav-main-link-name">Users</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route("user.all") }}">
                                <span class="nav-main-link-name">All Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route("user.pay") }}">
                        <i class="nav-main-link-icon fa fa-user-circle"></i>
                        <span class="nav-main-link-name">Add Money</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-piggy-bank"></i>
                        <span class="nav-main-link-name">Make Payments</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('user.transfer') }}">
                                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                <span class="nav-main-link-name">Send Money</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('user.aibopay-accounts.create') }}">
                                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                <span class="nav-main-link-name">Buy Airtime</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('user.aibopay-accounts.create') }}">
                                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                <span class="nav-main-link-name">Buy Data</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('user.aibopay-accounts.create') }}">
                                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                <span class="nav-main-link-name">Pay Utility</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-piggy-bank"></i>
                        <span class="nav-main-link-name">Aibopay Accounts</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('user.aibopay-accounts') }}">
                                <span class="nav-main-link-name">View all</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('user.aibopay-accounts.create') }}">
                                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                <span class="nav-main-link-name">New Account</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-piggy-bank"></i>
                        <span class="nav-main-link-name">ATM Cards</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('card.view') }}">
                                <span class="nav-main-link-name">View all</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('card.create') }}">
                                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                                <span class="nav-main-link-name">Add New Card</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-book"></i>
                        <span class="nav-main-link-name">Documents</span>
                    </a>
                    <ul class="nav-main-submenu">

                        @can('viewAny', \App\Models\UserKycDoc::class)
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route("kyc.all") }}">
                                <span class="nav-main-link-name">Manage KYC</span>
                            </a>
                        </li>

                        @endcan

                        @can('create', \App\Models\UserKycDoc::class)

                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route("kyc.create") }}">
                                <span class="nav-main-link-name">Add KYC Document</span>
                            </a>
                        </li>

                        @else

                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('kyc.approve', \Illuminate\Support\Facades\Auth::user()->userKycDoc->id) }}">
                                <span class="nav-main-link-name">View KYC Document</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>

                @can('viewAny', \App\Models\UserAbility::class)

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-book"></i>
                        <span class="nav-main-link-name">Role Management</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route("roles") }}">
                                <span class="nav-main-link-name">View all</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route("role.create") }}">
                                <span class="nav-main-link-name">Add New Role</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @endcan

                <li class="nav-main-heading">Personal</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route("profile") }}">
                        <i class="nav-main-link-icon fa fa-user-circle"></i>
                        <span class="nav-main-link-name">Profile</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="">
                        <i class="nav-main-link-icon fa fa-envelope"></i>
                        <span class="nav-main-link-name">Messages</span>
                        <span class="nav-main-link-badge badge rounded-pill bg-success">3</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-lock"></i>
                        <span class="nav-main-link-name">Security</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route("password.change") }}">
                                <span class="nav-main-link-name">Change Password</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="/">
                        <i class="nav-main-link-icon fa fa-arrow-left"></i>
                        <span class="nav-main-link-name">Homepage</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
