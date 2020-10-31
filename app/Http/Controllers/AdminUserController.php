<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function list(Request $request)
    {
        return User::get();
    }

    public function showById(Request $request, $id)
    {

    }

    public function add(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {
        return redirect('/admin', 301);
    }
}
