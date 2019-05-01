<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_an_user()
    {
        $project = factory(Project::class)->create();

        $another_user = factory(User::class)->create();

        $project->invite($another_user);

        $this->actingAs($another_user);

        $this->post(route('tasks.store', $project), [
            'body' => 'test task',
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'test task',
        ]);
    }
}
