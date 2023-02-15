<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\UserAbility;
use App\Models\Utility;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{

    /**
     * Display all Users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function viewAll(Request $request, $roleId = 0)
    {

        $sortBy = $request->sort ?? 'name';
        $orderBy = $request->order ?? 'asc';

        $users = ($roleId > 0)? UserAbility::find($roleId)->user : User::orderBy($sortBy, $orderBy)->paginate(12);

        return view('dashboard.user.user.all-user', ['users' => $users]);

    }

    public function activateOrDeactivateUser(Request $request, int $id) {

        $status = $request->locked;

        User::find($id)->update([
            'is_locked' => !$status
        ]);

        return redirect('/user/all');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('profile.edit', ['user' => Auth::user(), 'currencies' => Utility::AIBOPAY_ACCOUNT_CURRENCY]);

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(ProfileUpdateRequest $request, int $id)
    {
        if($request->validated() AND $request->user()->id === Auth::user()->id) {

            Auth::user()->update([
                'username' => $request->get('username'),
                'main_currency' => Utility::AIBOPAY_ACCOUNT_CURRENCY[$request->get('mainCurrency')],
                'date_of_birth' => $request->get('date_of_birth'),
                'image_path' => $request->image_path ? $this->storeImage($request) : Auth::user()->image_path
            ]);

            Auth::user()->userContact()->update([

                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'zip_or_postal_code' => $request->get('zip_or_postal_code'),
                'state' => $request->get('state'),
                'province' => $request->get('province'),
                'country' => $request->get('country'),
            ]);

            return redirect(RouteServiceProvider::HOME)->with('update_success', "Profile update successful");

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeImage(Request $request) {

        if(file_exists(Auth::user()->image_path)) {
            unlink(Auth::user()->image_path);
        }

        $name = str_replace(' ', '', $request->user()->name);
        $newImage = uniqid() . '-' . $name . '.' . $request->image_path->extension();

        $newImagePath = $request->image_path->move(public_path('assets/images/profile'), $newImage, true);
        return str_replace("\\", "/", str_replace("C:\Users\Ralph\Desktop\workspace\awazone-project\public", "", $newImagePath));
    }

    /**
     * Display list of authorities for users
     *
     * @return array $authorities
     */

    public function authorities(): array
    {
        return [];
    }
}
