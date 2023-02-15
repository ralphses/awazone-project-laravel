<x-layout.dashboard-layout>

    <x-layout.dashboardLayout.dashboard-side-bar></x-layout.dashboardLayout.dashboard-side-bar>
    <x-layout.dashboardLayout.dashboard-header></x-layout.dashboardLayout.dashboard-header>

    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Payment</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content"  style="width: 70%; align-self: center" >
            <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation"
                  action="{{ route('user.pay.start') }}"
                  method="post"

            @method('POST')
            @csrf
            <div class="block block-rounded">
                <div class="block-content block-content-full">

                    <!-- Regular -->

                    <h2 class="content-heading">Payment Details</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="form-label" for="amount">Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">

                        @if($errors->any('amount'))
                            <p style="color: red; font-size: small">{{ $errors->first('amount') }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="amount">Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="amount" name="description" value="{{ old('description') }}">

                        @if($errors->any('description'))
                            <p style="color: red; font-size: small">{{ $errors->first('description') }}</p>
                        @endif

                    </div>


                    <div class="mb-4">
                        <label class="form-label" for="val-username">Select payment method<span class="text-danger">*</span></label>
                        <select class="form-select" id="paymentMethod" name="pay-method">
                            <option selected="">Select...</option>
                            @foreach($methods as $method)
                                <option value="{{ $method }}">{{ $method }}</option>
                            @endforeach
                        </select>
                        @if($errors->any('pay-method'))
                            <p style="color: red; font-size: small">{{$errors->first('pay-method')}}</p>
                        @endif
                    </div>

                    <div class="mb-4" style="display: none" id="currency">
                        <label class="form-label" for="val-username">Select Currency<span class="text-danger">*</span></label>

                        <select class="form-select" id="currencyList" name="currency">
                            <option selected="">Select...</option>
                            @foreach($currencies as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @if($errors->any('currency'))
                            <p style="color: red; font-size: small">{{$errors->first('currency')}}</p>
                        @endif
                    </div>

                    <div class="mb-4" style="display: none" id="account">
                        <label class="form-label" for="val-username">Select Destination Account<span class="text-danger">*</span></label>

                        <div class="row">

                            @foreach($accounts as $account)

                            <div class="col-md-6 dest-account {{ $account->currency }}">
                                <div class="form-check form-block">
                                    <input class="form-check-input" type="radio" value="{{ $account->id }}" id="{{ $account->accountNumber }}" name="dest-account">
                                    <label class="form-check-label" for="{{ $account->accountNumber }}">
                                        <span class="d-flex align-items-center">
                                          <span class="ms-2">
                                            <span class="fw-bold">{{ $account->accountName }}</span>
                                            <span class="d-block fs-sm text-muted">{{ $account->accountNumber }}</span>
                                            <span class="d-block fs-sm text-muted">AiboPay Account</span>
                                            <span class="d-block fs-sm text-muted">{{ $account->balance }}</span>
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                                @if($errors->any('dest-account'))
                                    <p style="color: red; font-size: small">{{$errors->first('dest-account')}}</p>
                                @endif

                            @endforeach

                        </div>

                        @if($errors->any('account'))
                            <p style="color: red; font-size: small">{{$errors->first('account')}}</p>
                        @endif
                    </div>

                    <div class="mb-4" style="display: none" id="card">
                        <label class="form-label" for="val-username">Select Debit Card<span class="text-danger">*</span></label>
                        <select class="form-select" id="cardOption" name="card">
                            <option selected="">Select...</option>
                            @foreach($cards as $card)
                                <option value={{ $card->id }}>{{ $card->type. "|" .$card->number . "|" . $card->bank }}</option>
                            @endforeach
                            <option value=0>New Card</option>
                        </select>
                        @if($errors->any('card'))
                            <p style="color: red; font-size: small">{{$errors->first('card')}}</p>
                        @endif
                    </div>

                    <div style="display: none" id="newCard">
                        <div class="mb-4">
                            <label class="form-label" for="val-username">Card Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="card-number" name="card-number" value="{{ old('card-number')}}">

                            @if($errors->any('card-number'))
                                <p style="color: red; font-size: small">{{$errors->first('card-number')}}</p>
                            @endif

                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">Expiry Month and Year<span class="text-danger">*</span></label>
                            <input type="month" class="form-control" id="expiry-month" name="expiry-month" value="{{ old('expiry-month')}}">

                            @if($errors->any('expiry-month'))
                                <p style="color: red; font-size: small">{{$errors->first('expiry-month')}}</p>
                            @endif

                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">Card PIN<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="card-pin" name="card-pin" value="{{ old('card-pin') }}">

                            @if($errors->any('card-pin'))
                                <p style="color: red; font-size: small">{{ $errors->first('card-pin') }}</p>
                            @endif

                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="val-username">CVV<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="card-cvv" name="card-cvv" value="{{ old('card-cvv') }}">

                            @if($errors->any('card-cvv'))
                                <p style="color: red; font-size: small">{{ $errors->first('card-cvv') }}</p>
                            @endif

                        </div>
                    </div>



                    <h6 class="ava" style="display: none"><strong>Deposit or Transfer funds to this account</strong></h6>

                    <input value="transfer" hidden id="trans">

                   <div class="row">

                           <div class="col-md-6 monnifyAccount" style="display: none">
                               <div class="card card-borderless push">
                                   <div class="card-body">
                                       Account Name:<strong> {{ $monnifyAccount->customerName ?? "" }} </strong><br>
                                       Account Number: <strong>{{ $monnifyAccount->accountNumber ?? "" }}</strong><br>
                                       Bank: <strong>{{ $monnifyAccount->bank ?? "" }} </strong><br>
                                   </div>
                               </div>
                           </div>


                   </div>

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7 offset-lg-4" style="justify-content: center">
                            <input type="submit" id="submitBtn" class="btn btn-primary" style="width: 70%" value="Proceed">
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

    <script>
        const paymentMethod = document.querySelector('#paymentMethod');
        const currency = document.querySelector('#currencyList');
        const accounts = document.querySelectorAll('.thisAccount');
        const destAccount = document.querySelectorAll('.dest-account');
        const selectedCard = document.getElementById('cardOption');


        selectedCard.addEventListener('change', () => {

            let newCard = document.getElementById('newCard');

            if(selectedCard.options[selectedCard.selectedIndex].value === "0") {
                newCard.style.display = "block";
            }
            else newCard.style.display = "none";
        });

        paymentMethod.addEventListener('change', () => {

            const method = paymentMethod.options[paymentMethod.selectedIndex].value;

            if(method === "DEBIT/CREDIT CARD") {

                document.querySelectorAll(".ava").forEach((element) => element.style.display = "none");

                document.querySelector("#submitBtn").value = "Proceed";
                document.querySelector("#currency").style.display = "block";
                document.querySelector("#card").style.display = "block";
                accounts.forEach((value) => value.style.display = "none")
                document.querySelector('.monnifyAccount').style.display = 'none';

            }
            else if(method === "TRANSFER/DEPOSIT") {

                document.querySelector("#currency").style.display = "non";
                document.querySelector("#submitBtn").value = "Complete";
                document.querySelector("#account").style.display = "none";
                document.querySelector("#card").style.display = "none";
                document.querySelector("#trans").name = "transfer";

                document.querySelectorAll('.ava').forEach((element) => element.style.display ="block")
                document.querySelector('.monnifyAccount').style.display = 'block';


            }

            else {
                document.querySelector("#submitBtn").value = "Proceed";
                document.querySelector("#currency").style.display = "none";
                document.querySelector("#account").style.display = "none";
                document.querySelector("#card").style.display = "none";
                accounts.forEach((value) => value.style.display = "none")

            }
        });

        currency.addEventListener('change', () => {

            accounts.forEach((value) => value.style.display = "none")
            destAccount.forEach((value) => value.style.display = "none")


            const thisCurrency = currency.options[currency.selectedIndex].value;


            if(paymentMethod.options[paymentMethod.selectedIndex].value === "DEBIT/CREDIT CARD") {

                document.querySelectorAll('.dest-account')
                    .forEach((value) => value.style.display = (value.classList.contains(thisCurrency)) ? "block" : "none");
                document.getElementById("account").style.display = "block";
                document.querySelector(".ava").style.display = "none";

            }
            else if(paymentMethod.options[paymentMethod.selectedIndex].value === "TRANSFER/DEPOSIT") {
                // document.querySelectorAll('.ava').forEach((element) => element.style.display ="block")
                // accounts.forEach((key) => key.style.display = key.classList.contains(thisCurrency) ? "block" : "none");
            }
            // else ;

        });

    </script>

    <!-- Page JS Code -->
    <script src="/assets/dashboard/assets/js/pages/be_forms_validation.min.js"></script>

</x-layout.dashboard-layout>
