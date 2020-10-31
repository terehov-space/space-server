<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function list()
    {
        $project = Project::get();
        return view('projects.list')->with('projects', $project);
    }
}
