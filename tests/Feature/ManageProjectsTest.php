<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Project;
use Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
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

        $this->get('/projects/create')->assertStatus(200);

        $project = factory(Project::class)->raw([
            'owner_id' => $user->id
        ]);

        $this->post('/projects', $project);

        $this->assertDatabaseHas('projects', $project);

        $project = Project::where('title', $project['title'])->first();

        $this->get($project->path)
            ->assertSee($project['title'])
            ->assertSee($project['notes']);
    }

    /** @test */
    public function the_authorized_user_can_update_project()
    {
        $user = $this->authenticate();

        $project = factory(Project::class)->create([
            'owner_id' => $user->id
        ]);

        $this->get($project->path . '/edit')->assertStatus(200);

        $data = [
            'title' => 'updated_title',
            'description' => 'updated_description',
        ];

        $this->patch(route('projects.update', $project->id), $data)
            ->assertStatus(302);

        $this->assertDatabaseHas('projects', [
            'title' => 'updated_title',
            'description' => 'updated_description',
        ]);

        $data = [
            'notes' => 'updated_notes'
        ];

        $this->patch(route('projects.update-notes', $project->id), $data)
            ->assertStatus(302);

        $this->assertDatabaseHas('projects', [
            'notes' => 'updated_notes',
        ]);

        $this->authenticate();

        $data = [
            'title' => 'unauthorized update',
            'description' => 'unauthorized update',
        ];

        $this->patch(route('projects.update', $project->id), $data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('projects', [
            'notes' => 'unauthorized update',
        ]);
    }

    /** @test */
    public function the_authorized_user_can_delete_a_project()
    {
        $user = $this->authenticate();

        $project = factory(Project::class)->create([
            'owner_id' => $user->id
        ]);

        $this->delete($project->path)->assertRedirect(route('projects.index'));
        $this->assertDatabaseMissing('projects', $project->only('id'));

        $another_project = factory(Project::class)->create();

        $this->delete($another_project->path)->assertStatus(403);
        $this->assertDatabaseHas('projects', $another_project->only('id'));
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->authenticate();

        $project = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $project)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function the_project_title_is_unique()
    {
        $this->authenticate();

        $project = app(ProjectFactory::class)->create();

        $other_project = factory(Project::class)->raw([
            'title' => $project->title,
        ]);

        $this->post('/projects', $other_project)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->authenticate();

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
        $user = $this->authenticate();

        $project = factory(Project::class)->create(['owner_id' => $user->id]);

        $this->get($project->path)
            ->assertSee($project->title)
            ->assertSee($project->description);

        $this->get($project->path . '/edit')
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function the_project_can_not_be_viewed_from_another_user()
    {
        $this->authenticate();

        $another_user = factory(User::class)->create();

        $project = factory(Project::class)->create(['owner_id' => $another_user->id]);

        $this->get($project->path)
            ->assertDontSee($project->title)
            ->assertDontSee($project->description)
            ->assertStatus(403);

        $this->get($project->path . '/edit')
            ->assertDontSee($project->title)
            ->assertDontSee($project->description)
            ->assertStatus(403);
    }

    /** @test */
    public function the_authenticated_user_can_view_only_his_projects_on_the_index()
    {
        $user = $this->authenticate();

        $project = factory(Project::class)->create(['owner_id' => $user->id]);

        $this->get(route('projects.index'))
            ->assertSee($project->title);

        $another_user = factory(User::class)->create();

        $another_project = factory(Project::class)->create(['owner_id' => $another_user->id]);

        $this->get(route('projects.index'))
            ->assertDontSee($another_project->title);
    }
}
