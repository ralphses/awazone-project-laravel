<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAbility;
use App\Models\UserContact;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $referralCode = $request->query->get('referralCode') ?? false;
        return view('auth.register', ['referralCode' => $referralCode]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $userAbility = UserAbility::where('name', 'User')->get()->value('id') ?? UserAbility::create([
                'name' => 'User',
                'token' => uniqid('user', true)
            ])->get()->value('id');


        $referralCode = $request->get('referralCode') ?? false;

        $userReferrer = ($referralCode) ? User::where('referral_code', $referralCode)->get()->value('referral_code') : null;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => substr($request->email, 0, strpos($request->email, '@')),
            'password' => Hash::make($request->password),
            'referer_user' => $userReferrer,
            'user_ability_id' => $userAbility,
            'referral_code' => substr($request->email, 0, strpos($request->email, '@'))
        ]);

        UserContact::create(['user_id' => $user->id]);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
