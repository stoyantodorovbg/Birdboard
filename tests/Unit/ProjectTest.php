<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $project = factory(Project::class)->create();

        $this->assertEquals('/projects/' . $project->id, $project->path);
    }

    /** @test */
    public function an_project_belongs_to_an_owner()
    {
        $project = factory(Project::class)->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }
}
