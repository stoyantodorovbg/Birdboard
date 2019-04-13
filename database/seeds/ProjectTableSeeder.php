<?php

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 10)->create([
            'owner_id' => 1,
        ]);

        factory(Project::class, 10)->create([
            'owner_id' => 2,
        ]);

        factory(Project::class, 10)->create();
    }
}
