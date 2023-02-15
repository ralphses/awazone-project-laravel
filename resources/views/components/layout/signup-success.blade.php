<!-- Start Hero -->
<section class="relative h-screen flex justify-center items-center bg-slate-50 dark:bg-slate-800">
    <div class="container">
        <div class="md:flex justify-center">
            <div class="lg:w-2/5">
                <div class="relative overflow-hidden rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800">
                    <div class="px-6 py-12 bg-emerald-600 text-center">
                        <i class="uil uil-check-circle text-white text-8xl"></i>
                        <h5 class="text-white text-xl tracking-wide uppercase font-semibold mt-2">Success</h5>
                    </div>

                    <div class="px-6 py-12 text-center">
                        <p class="text-black font-semibold text-xl dark:text-white">Congratulations! 🎉</p>
                        <p class="text-slate-400 mt-4">A new verification link has been sent to the email address you provided during registration.</p>

                        <div class="mt-6">

                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <x-primary-button>
                                        {{ __('Resend Verification Email') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center p-6 border-t border-gray-100 dark:border-gray-700">
                        <p class="mb-0 text-slate-400">© <script>document.write(new Date().getFullYear())</script> Techwind. Design with <i class="mdi mdi-heart text-red-600"></i> by <a href="https://shreethemes.in/" target="_blank" class="text-reset">Shreethemes</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->
