<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->name,
            'description' => $this->faker->sentence,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects', $attributes)->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $project = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $project)->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $project = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', [])->assertSessionHasErrors(['description']);
    }
}
