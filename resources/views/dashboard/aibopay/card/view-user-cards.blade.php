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

            @if($cards != null)
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Custom Text here></h3>
                        <div class="block-options">
                            <a href="{{ route('card.create') }}">
                                <button type="button" class="btn btn-alt-primary">
                                    Add New Card
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="block-content">
                        <h2 class="content-heading">
                            <i class="fa fa-angle-right text-muted me-1"></i> Cards ({{ $cards->count() }})
                        </h2>
                        <div class="row">
                            @foreach($cards as $card)

                            <div class="col-xl-4">
                                <!-- Card #1 -->

                                <div class="block block-rounded block-link-shadow" style="background-color: ghostwhite">
                                    <div class="block-content block-content-full ribbon ribbon-dark ribbon-modern ribbon-primary">
                                        <div>
                                            <form action="{{ route('card.delete', $card->id) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>

                                        </div>
                                        <div class="py-3 text-center">
                                            <i class="fa fa-credit-card fa-4x text-gray"></i>
                                            <p class="fs-lg text-dark mt-3 mb-0">
                                                Henry Harrison
                                            </p>
                                            <p class="text-muted mb-3">
                                                4309-xxxx-xxxx-7898
                                            </p>
                                            <p class="fs-sm fw-bold text-muted mb-0">
                                                VISA
                                            </p>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full block-content-sm text-center bg-body-light">
                                        <span class="fs-sm text-muted">Active through May 2025</span>
                                    </div>
                                </div>
                                <!-- END Card #1 -->
                            </div>
                            @endforeach

                        </div>

                    </div>

                </div>

            @else
                <div class="block block-rounded">
                    <div class="block-content block-content-full flex-ce">
                        <div class="row text-center" style="justify-content: center">
                            <div class="col-md-10 py-3">
                                <div class="fs-1 fw-light text-primary-darker mb-1">
                                    You have not added any Card yet
                                </div>
                                <a class=" fs-sm fw-bold text-uppercase text-muted" href="{{ route('card.create') }}">
                                    <button type="button" class="btn btn-alt-primary">
                                        Add new Card
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
