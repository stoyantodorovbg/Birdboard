<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_user_has_projects()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function an_user_has_accessible_projects()
    {
        $user = $this->authenticate();

        factory(Project::class)->create([
            'owner_id' => $user->id,
        ]);

        $this->assertCount(1, $user->accessibleProjects());

        factory(Project::class)->create([
            'owner_id' => factory(User::class)->create()->id,
        ])->invite($user);

        $this->assertCount(2, $user->accessibleProjects());

        factory(Project::class)->create([
            'owner_id' => factory(User::class)->create()->id,
        ])->invite(factory(User::class)->create());

        $this->assertCount(2, $user->accessibleProjects());
    }
}
