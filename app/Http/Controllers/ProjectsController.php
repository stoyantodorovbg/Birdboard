<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectsController extends Controller
{
    /**
     * Lists projects
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $projects = auth()->user()->projects()->orderBy('updated_at', 'DESC')->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show a project
     *
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load('tasks');

        return view('projects.show', compact('project'));
    }

    /**
     * Create a project
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a project
     *
     * @param ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectRequest $request)
    {
        $project = auth()->user()->projects()->create($request->all());

        return redirect()->route('projects.show', $project)->with(['project' => $project]);
    }

    /**
     * Update a project
     *
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update(request()->all());

        return redirect()->route('projects.show', $project)->with(['project' => $project]);
    }
}
