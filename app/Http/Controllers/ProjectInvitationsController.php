<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationsRequest;
use App\Models\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    /**
     * Invite an user to a project
     *
     * @param ProjectInvitationsRequest $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ProjectInvitationsRequest $request,  Project $project)
    {
        $user = User::where('email', $request->email)->first();

        $project->invite($user);

        return redirect()->route('projects.show', $project);
    }
}
