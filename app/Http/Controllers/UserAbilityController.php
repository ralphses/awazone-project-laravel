<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAbility;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserAbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $allRoles = [];

        $modelRole = UserAbility::orderBy('name', 'asc')->paginate(10);

        foreach ($modelRole as $role) {

            $allUsers = [];

            foreach ($role->user as $user) {

                $singleUser = [
                    'name' => $user->name,
                    'email' => $user->email
                ];

                $allUsers[$user->name] = $singleUser;
            }

            $allRoles[$role->name] = [
                'description' => $role->description,
                'id' => $role->id,
                'authorities' => $role->abilities(),
                'users' => $allUsers
            ];

        }

        return view('dashboard.user.roles.show-user-roles', ['roles' => $allRoles, 'model' => $modelRole]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.user.roles.new-user-ability-form', ['abilities' => Utility::USER_ABILITIES]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique(UserAbility::class)],
            'description' => ['required', 'string']
        ]);

        $description = $request->get('description');

        $abilities = $this->buildAbilities($request);


        if(strcmp($abilities, "")) {

            UserAbility::create([
                'name' => $request->get('name'),
                'description' => $description,
                'abilities' => $abilities,
                'token' => uniqid()
            ]);
        }

        return redirect('/user/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function assignRoleToUser(int $id) : View
    {
        return view("dashboard.user.roles.assign-role-to-user", ['user' => User::find($id), 'roles' => UserAbility::get()]);
    }

    public function storeAssignedRoleToUser(Request $request, int $id) {
        $user = User::find($id) ?? false;
        $role = UserAbility::find($request->get('role')) ?? false;

        if($user and $role) {
            $user->update([
                'user_ability_id' => $role->id
            ]);
        }

        return redirect('/user/all');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        return view('dashboard.user.roles.edit-user-ability-form', [
            'role' => UserAbility::find($id),
            'otherRoles' => Utility::USER_ABILITIES
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {

        $role = UserAbility::find($id);

        $request->validate([
            'name' => ['required', 'string', Rule::unique(UserAbility::class)->ignore($role->id)],
            'description' => ['required', 'string']
        ]);

        $description = $request->get('description');

        $abilities = $this->buildAbilities($request);


        if(strcmp($abilities, "")) {

            $role->update([
                'name' => $request->get('name'),
                'description' => $description,
                'abilities' => $abilities,
            ]);
        }
        return redirect('/user/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        if($id !== 1) {
            UserAbility::destroy($id);
            return redirect('/user/roles')->with(['message' => 'Role deleted']);
        }
        else {
            return redirect('/user/roles')->with(['message' => 'This role cannot be deleted']);
        }
    }

    /**
     * @param Request $request
     * @param mixed $abilities
     * @return string
     */
    private function buildAbilities(Request $request): string
    {
        $abilities = '';

        $singleAuth = [];
        $allAuth = array_values(Utility::USER_ABILITIES);

        foreach ($allAuth as $auth) {
            $singleAuth = array_merge($singleAuth, $auth);
        }

        foreach ($request->request->all() as $key => $value) {
            if (in_array($key, $singleAuth)) {
                $abilities = $abilities . $value . "|";
            }
        }
        return $abilities;
    }
}
