<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    /**
     * Create a task
     *
     * @param TaskRequest $request
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(TaskRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->addTask($request->body);

        return view('projects.show', compact('project'));
    }
}
