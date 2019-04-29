<?php

namespace App\Http\Controllers;

use App\Models\Task;
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

        return redirect()->back();
    }

    /**
     * Update a task
     *
     * @param TaskRequest $request
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|int
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $project);

        if($project->id != $task->project_id) {
            return response('Unauthorizd!', 403);
        }

        $task->update([
            'body' => $request->body,
            'completed' => $request->has('completed'),
        ]);

        return back();
    }
}
