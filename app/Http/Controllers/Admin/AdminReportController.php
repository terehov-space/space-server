<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function list(Request $request)
    {
        $projectsByTag = DB::table('projects')->selectRaw('tags.title, COUNT(projects.id) AS cnt')
        ->leftJoin('tags', 'projects.tag_id', '=', 'tags.id')
        ->groupBy('tags.title')->get();

        $tasksByTag = DB::table('tasks')->selectRaw('tags.title, COUNT(tasks.id) AS cnt')
        ->leftJoin('tags', 'tasks.tag_id', '=', 'tags.id')
        ->groupBy('tags.title')->get();

        $usersByRole = DB::table('roles')->selectRaw('roles.title, COUNT(users_roles.user_id) AS cnt')
        ->leftJoin('users_roles', 'roles.id', '=', 'role_id')
        ->groupBy('roles.title')->get();


        return view('admin.reports.list')->with('projectsByStatus', $projectsByTag)
        ->with('tasksByStatus', $tasksByTag)
        ->with('usersByRoles', $usersByRole);
    }
}
