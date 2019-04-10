<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function the_guests_cannot_create_a_project()
    {
        $project = factory(Project::class)->raw();

        $this->post('/projects', $project)->assertRedirect('login');
    }

    /** @test */
    public function the_authenticated_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $project = factory(Project::class)->raw(['owner_id' => $user->id]);

        $this->post('/projects', $project)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $project);

        $this->get('/projects', $project)->assertSee($project['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->actingAs(factory(User::class)->create());

        $project = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $project)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(factory(User::class)->create());

        $project = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $project)->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function the_guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');

        $project = factory(Project::class)->create();

        $this->get($project->path)->assertRedirect('login');
    }

    /** @test */
    public function the_project_can_be_viewed_from_his_owner()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $project = factory(Project::class)->create(['owner_id' => $user->id]);

        $this->get($project->path)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function the_project_can_not_be_viewed_from_another_user()
    {
        $this->actingAs(factory(User::class)->create());

        $another_user = factory(User::class)->create();

        $project = factory(Project::class)->create(['owner_id' => $another_user->id]);

        $this->get($project->path)
            ->assertDontSee($project->title)
            ->assertDontSee($project->description)
            ->assertStatus(403);
    }

    /** @test */
    public function the_authenticated_user_can_view_only_his_projects_on_the_index()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $project = factory(Project::class)->create(['owner_id' => $user->id]);

        $this->get(route('projects.index'))
            ->assertSee($project->title);

        $another_user = factory(User::class)->create();

        $another_project = factory(Project::class)->create(['owner_id' => $another_user->id]);

        $this->get(route('projects.index'))
            ->assertDontSee($another_project->title);
    }
}
