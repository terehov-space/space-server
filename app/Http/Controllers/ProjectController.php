<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function list()
    {
        $project = Project::get();
        return view('projects.list')->with('projects', $project);
    }

    public function add(Request $request)
    {
        $newProjectData = $request->all();
        $newProjectData['deadline'] = ($newProjectData['deadline'])? (new Carbon($newProjectData['deadline']))->toDateString(): '';
        $newProjectData['created_by'] = $request->user()->id;
        $newProjectData['assigned_to'] = $request->user()->id;

        Project::create($newProjectData);

        return redirect('/dash/projects', 301);
    }
}
