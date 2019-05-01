<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $user = $this->authenticate();

        $project = factory(Project::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->assertEquals($user->id, $project->activities->first()->user->id);
    }
}
