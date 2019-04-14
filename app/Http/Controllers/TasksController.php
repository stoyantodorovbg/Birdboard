<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    /**
     * @param TaskRequest $request
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(TaskRequest $request, Project $project)
    {
        $project->addTask($request->body);

        return view('projects.show', compact('project'));
    }
}
