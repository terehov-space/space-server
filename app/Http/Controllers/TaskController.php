<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function list(Request $request, $project)
    {
        $task = Task::where('project_id', $project)->get();
        return view('tasks.list')->with('tasks', $task)->with('project', $project);
    }

    public function addPage(Request $request, $project)
    {
        return view('tasks.add')->with('users', User::get())->with('project', $project);
    }

    public function add(Request $request, $project)
    {
        $newTaskData = $request->all();
        $newTaskData['deadline'] = ($newTaskData['deadline'])? (new Carbon($newTaskData['deadline']))->toDateString(): '';
        $newTaskData['created_by'] = $request->user()->id;
        $newTaskData['assigned_to'] = $request->input('assigned_to');
        $newTaskData['project_id'] = $request->input('project_id');

        unset($newTaskData['_token']);

        Task::create($newTaskData);

        return redirect('/dash/projects/' . $project . '/tasks', 301);
    }

    public function edit(Request $request, $project, $id)
    {
        return view('tasks.edit')->with('project', Task::findOrFail($id));
    }

    public function delete(Request $request, $project, $id)
    {
        $project = Task::findOrFail($id);
        $project->deleted = 0;
        $project->save();

        return redirect('/dash/projects/' . $project->id, 301);
    }

    public function update(Request $request, $project, $id)
    {
        $project = Task::findOrFail($id);
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->deadline = ($request->input('deadline'))? (new Carbon($request->input('deadline')))->toDateString(): '';

        if ($project->isDirty()) {
            $project->save();
        }

        return redirect('/dash/projects/' . $project->id, 301);
    }
}
