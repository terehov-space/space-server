<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function list()
    {
        $project = Project::get();
        return view('projects.list')->with('projects', $project);
    }

    public function addPage(Request $request)
    {
        return view('projects.add')->with('users', User::get());
    }

    public function add(Request $request)
    {
        $newProjectData = $request->all();
        $newProjectData['deadline'] = ($newProjectData['deadline'])? (new Carbon($newProjectData['deadline']))->toDateString(): '';
        $newProjectData['created_by'] = $request->user()->id;
        $newProjectData['assigned_to'] = $request->input('assigned_to');

        unset($newProjectData['_token']);

        Project::create($newProjectData);

        return redirect('/dash/projects', 301);
    }

    public function edit(Request $request, $id)
    {
        return view('projects.edit')->with('project', Project::findOrFail($id))->with('users', User::get());
    }

    public function delete(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->deleted = 1;
        $project->save();

        return redirect('/dash/projects/' . $project->id, 301);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->deadline = ($request->input('deadline'))? (new Carbon($request->input('deadline')))->toDateString(): '';
        $project->assigned_to = $request->input('assigned_to');

        if ($project->isDirty()) {
            $project->save();
        }

        return redirect('/dash/projects/' . $project->id, 301);
    }
}
