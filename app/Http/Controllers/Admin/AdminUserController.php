<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function list(Request $request)
    {
        return view('admin.users.list')->with('users', User::get());
    }

    public function showById(Request $request, $id)
    {
        return view('admin.users.edit')->with(['user' => User::findOrFail($id), 'roles' => Role::get()]);
    }

    public function add(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');

        if ($user->isDirty()) {
            $user->save();
        }

        $roles = Role::whereIn('id', $request->input('role'))->get();

        $user->roles()->detach();

        $roles->each(function($role) use($user) {
            $user->roles()->save($role);
        });

        return redirect('/dash/users/' . $user->id, 301);
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->deleted = 1;
        $user->save();
        return redirect('/dash/users', 301);
    }
}
