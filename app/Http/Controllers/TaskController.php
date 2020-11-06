<?php

namespace App\Http\Controllers;

use App\Models\Message;
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

    public function developer(Request $request)
    {
        $task = Task::where('assigned_to', $request->user()->id)->get();
        return view('tasks.list_developer')->with('tasks', $task);
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
        return view('tasks.edit')->with('task', Task::findOrFail($id))->with('project', $project)->with('users', User::get());
    }

    public function delete(Request $request, $project, $id)
    {
        $task = Task::findOrFail($id);
        $task->deleted = 1;
        $task->save();

        return redirect('/dash/projects/' . $project . '/tasks/' . $task->id, 301);
    }

    public function update(Request $request, $project, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->deadline = ($request->input('deadline'))? (new Carbon($request->input('deadline')))->toDateString(): '';
        $task->assigned_to = $request->input('assigned_to');

        if ($task->isDirty()) {
            $task->save();
        }

        return redirect('/dash/projects/' . $project . '/tasks/' . $task->id, 301);
    }

    public function takeToWork(Request $request, $project, $id)
    {
        $task = Task::findOrFail($id);
        $task->tag_id = 5;
        $task->save();

        return redirect('/dash/projects/' . $project . '/tasks/' . $task->id, 301);
    }

    public function sendToCheck(Request $request, $project, $id)
    {
        $task = Task::findOrFail($id);
        $task->tag_id = 6;
        $task->save();

        return redirect('/dash/projects/' . $project . '/tasks/' . $task->id, 301);
    }

    public function setChecked(Request $request, $project, $id)
    {
        $task = Task::findOrFail($id);
        $task->tag_id = 7;
        $task->save();

        return redirect('/dash/projects/' . $project . '/tasks/' . $task->id, 301);
    }

    public function sendToWork(Request $request, $project, $id)
    {
        $task = Task::findOrFail($id);
        $task->tag_id = 5;
        $task->save();

        return redirect('/dash/projects/' . $project . '/tasks/' . $task->id, 301);
    }

    public function comment(Request $request, $project, $id)
    {
        Message::create([
            'message' => $request->input('message'),
            'user_id' => $request->user()->id,
            'task_id' => $id,
        ]);

        return redirect('/dash/projects/' . $project . '/tasks/' . $id, 301);
    }
}
