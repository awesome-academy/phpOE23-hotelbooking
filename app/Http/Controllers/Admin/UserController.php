<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserContract;
use App\Repositories\Interfaces\RoleContract;

class UserController extends AdminController
{
    protected $userRepo;
    protected $roleRepo;

    public function __construct(UserContract $user, RoleContract $role)
    {
        $this->userRepo = $user;
        $this->roleRepo = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepo->all();
        $roles = $this->roleRepo->all();

        return view('admin.users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepo->getById($id);
        $roles = $this->roleRepo->all();

        foreach ($user->roles as $role) {
            if (! in_array($role->name, config('default.hard_roles'))) {
                $user->detachRole($role->name);
            }
        }

        foreach ($roles as $role) {
            if ($request->get(config('default.rolerq') . $role->id) == config('default.yes')) {
                $user->attachRole($role->id);
            }
        }

        return redirect()->route('admin_users_index')->with('message', trans('admin.user_update'));
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
}
