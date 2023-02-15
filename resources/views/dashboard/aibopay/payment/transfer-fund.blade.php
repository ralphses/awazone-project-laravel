<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>

    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Add new Card</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content"  style="width: 70%; align-self: center" >
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action="{{ route('user.transfer.start') }}"
                  method="post"

            @method('POST')
            @csrf
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <!-- Regular -->
                    <h2 class="content-heading">Transfer Funds</h2>

                    @if(session('validate-message'))
                    <div class="alert alert-danger" >
                        <ul>
                            <li>{{ session('validate-message') }}</li>
                        </ul>
                    </div>
                    @endif



                    <div class="mb-4">
                        <label class="form-label" for="transfer-amount">Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="transfer-amount" name="transfer-amount" value="{{ old('transfer-amount')}}">

                        @if($errors->any('transfer-amount'))
                            <p style="color: red; font-size: small">{{$errors->first('transfer-amount')}}</p>
                        @endif

                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="transfer-bank">Destination Bank<span class="text-danger">*</span></label>
                        <select class="form-select" id="transfer-bank" name="transfer-bank">
                            <option value="000" selected>Select...</option>
                            @foreach($banks as $key => $bank)
                                <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                            @endforeach
                        </select>
                        @if($errors->any('transfer-bank'))
                            <p style="color: red; font-size: small">{{$errors->first('transfer-bank')}}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="transfer-account">Destination Account number<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="transfer-account" name="transfer-account" value="{{ old('transfer-account')}}">

                        @if($errors->any('transfer-account'))
                            <p style="color: red; font-size: small">{{$errors->first('transfer-account')}}</p>
                        @endif

                    </div>

                    <div class="mb-4" style="display: {{ session()->get('account-name') ? 'block' : 'none' }}">
                        <label class="form-label" for="transfer-account-name">Destination Account name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="transfer-account-name" name="transfer-account-name" value="{{session()->get('account-name') ? session()->get('account-name') : old('transfer-account-name')}}" readonly>

                        @if($errors->any('transfer-account-name'))
                            <p style="color: red; font-size: small">{{$errors->first('transfer-account-name')}}</p>
                        @endif

                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="transfer-note">Add Note<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="transfer-note" name="transfer-note" value="{{ old('transfer-note')}}">

                        @if($errors->any('transfer-note'))
                            <p style="color: red; font-size: small">{{$errors->first('transfer-note')}}</p>
                        @endif

                    </div>

                    <div class="mb-4" id="account" style="display: {{ session('account-name') ? "block" : "none" }}">
                        <label class="form-label" for="val-username">Select Account to transfer from<span class="text-danger">*</span></label>

                        <div class="row">

                            @foreach($accounts as $account)

                                <div class="col-md-6 dest-account {{ $account->currency }}">
                                    <div class="form-check form-block">
                                        <input class="form-check-input" type="radio" value="{{ $account->id }}" id="{{ $account->accountNumber }}" name="origin-account">
                                        <label class="form-check-label" for="{{ $account->accountNumber }}">
                                        <span class="d-flex align-items-center">
                                          <span class="ms-2">
                                            <span class="fw-bold">{{ $account->accountName }}</span>
                                            <span class="d-block fs-sm text-muted">{{ $account->accountNumber }}</span>
                                            <span class="d-block fs-sm text-muted">AiboPay Account</span>
                                            <span class="d-block fs-sm text-muted {{ $account->accountNumber }} balance">{{ $account->balance }}</span>
                                          </span>
                                        </span>
                                        </label>
                                    </div>
                                </div>

                            @endforeach
                                <div class="col-md-6 dest-account">
                                    <div class="form-check form-block">
                                        <input class="form-check-input" id="any" type="radio" value="0" name="origin-account">
                                        <label class="form-check-label" for="any">
                                        <span class="d-flex align-items-center">
                                          <span class="ms-2">
                                            <span class="fw-bold">Any Account</span>
                                          </span>
                                        </span>
                                        </label>
                                    </div>
                                </div>
                            @if($errors->any('dest-account'))
                                <p style="color: red; font-size: small">{{$errors->first('origin-account')}}</p>
                            @endif

                        </div>

                        @if($errors->any('account'))
                            <p style="color: red; font-size: small">{{$errors->first('account')}}</p>
                        @endif
                    </div>

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7 offset-lg-4" style="justify-content: center">
                            <button type="submit" class="btn btn-primary" style="width: 70%">@if(session('account-name')) Confirm @else Validate @endif</button>
                        </div>
                    </div>
                    <!-- END Submit -->
                </div>
            </div>
            </form>
            <!-- jQuery Validation -->
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

        const transferBank = document.getElementById('transfer-bank');
        const transferAccount = document.getElementById('transfer-account');

        transferAccount.addEventListener('input', () => {
            if(transferAccount.value.length > 10) {
                transferAccount.value = transferAccount.value.substring(0, 10);
            }
        });

    </script>

</x-layout.dashboard-layout>
