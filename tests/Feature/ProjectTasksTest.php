<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_guests_cannot_add_tasks_to_the_projects()
    {
        $project = factory(Project::class)->create();

        $this->post(route('tasks.store', [
            'project' => $project->id,
            'body' => 'Test task',
        ]))->assertRedirect('login');
    }

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
    public function a_task_can_be_updated_only_from_his_owner()
    {
        $user = factory(User::class)->create();

        $project = factory(Project::class)->create([
            'owner_id' => $user->id,
        ]);

        $task = factory(Task::class)->create([
            'project_id' => $project->id,
        ]);

        $this->authenticate();

        $this->patch($task->path, [
            'body' => 'Test task',
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'Test task'
        ]);

        $this->authenticate($user);

        $this->patch($task->path, [
            'body' => 'Test task',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Test task',
            'completed' => 1,
        ]);
    }

    /** @test */
    public function only_the_project_owner_may_add_tasks_to_it()
    {
        $this->authenticate();

        $another_user = factory(User::class)->create();

        $project = factory(Project::class)->create([
            'owner_id' => $another_user->id,
        ]);

        $this->post(route('tasks.store', [
            'project' => $project->id,
            'body' => 'Test task',
        ]))->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
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
