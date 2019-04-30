<?php

namespace Tests\Feature;

use Tests\Setup\ProjectFactory;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project_generates_an_activity()
    {
        $project = factory(Project::class)->create();

        $this->assertCount(1, $project->activities);
        $this->assertNull($project->activities->last()->changes);
    }

    /** @test */
    public function project_activity_action_contains_user_name()
    {
        $project = factory(Project::class)->create();

        $this->assertDatabaseHas('activities', [
            'action' => 'New Project - ' . $project->title . ' - has been created from ' . $project->owner->name . '.',
        ]);
    }

    /** @test */
    public function updating_a_project_generates_an_activity()
    {
        $project = factory(Project::class)->create();
        $project_title = $project->title;

        $project->update([
            'title' => 'Updated title'
        ]);

        $this->assertCount(2, $project->activities);

        $this->assertContains('title', $project->activities->last()->action);
        $this->assertContains('property', $project->activities->last()->action);

        $expected_changes = [
            'before' => ['title' => $project_title],
            'after' => ['title' => 'Updated title'],
        ];

        $this->assertEquals($project->activities->last()->changes, $expected_changes);

        $project->update([
            'title' => 'Updated title 1',
            'description' => 'Updated description',
        ]);

        $project = $project->fresh();

        $this->assertCount(3, $project->activities);
        $this->assertContains('title', $project->activities->last()->action);
        $this->assertContains('description', $project->activities->last()->action);
        $this->assertContains('properties', $project->activities->last()->action);
    }

    /** @test */
    public function creating_a_task_generates_an_activity()
    {
        $project = app(ProjectFactory::class)->withTasks(1)->create();

        $this->assertCount(2, $project->activities);

        $project->tasks->last()->update([
            'body' => 'updated',
        ]);

        $this->assertCount(3, $project->fresh()->activities);
    }

    /** @test */
    public function task_deleting_generates_an_activity()
    {
        $project = app(ProjectFactory::class)->withTasks(1)->create();

        $project->tasks->last()->delete();

        $this->assertCount(3, $project->fresh()->activities);
    }
}
