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
    public function the_users_which_are_not_owners_or_members_of_the_project_can_not_invite_to_it()
    {
        $project = factory(Project::class)->create();

        $user = factory(User::class)->create();

        $this->authenticate();

        $this->post(route('projects.invite', $project->id), [
            'email' => $user->email,
        ])->assertStatus(403);
    }

    /** @test */
    public function the_project_can_invite_an_user()
    {
        $project = factory(Project::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($project->owner)->post(route('projects.invite', $project->id), [
            'email' => $user->email,
        ])->assertRedirect($project->path);

        $this->assertTrue($project->members->contains($user));
    }

    /** @test */
    public function the_invited_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        $project = factory(Project::class)->create();

        $this->actingAs($project->owner)->post(route('projects.invite', $project->id), [
            'email' => 'not_a_user@example.com',
        ])
            ->assertSessionHasErrors([
            'email' => 'The invited user must have a Birdboard account.',
        ]);

    }

    /** @test */
    public function the_invited_user_can_update_the_project()
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
