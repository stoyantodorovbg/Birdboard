<?php

namespace Tests\Feature;

use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $user = $this->authenticate();

        $project = factory(Project::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->post(route('tasks.store', [
            'project' => $project->id,
            'body' => 'Test task',
        ]));

        $this->get($project->path)->assertSee('Test task');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $user = $this->authenticate();

        $project = factory(Project::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->post(route('tasks.store', [
            'project' => $project->id,
            'body' => '',
        ]))->assertSessionHasErrors('body');
    }
}
