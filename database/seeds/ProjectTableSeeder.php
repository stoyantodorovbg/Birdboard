<?php

use App\Models\Task;
use Faker\Generator;
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
        $projects = factory(Project::class, 10)->create([
            'owner_id' => 1,
        ]);
        $this->addTasks($projects);

        $projects = factory(Project::class, 10)->create([
            'owner_id' => 2,
        ]);
        $this->addTasks($projects);

        $projects = factory(Project::class, 10)->create();
        $this->addTasks($projects);
    }

    /**
     * Add a task to each project of projects collection
     *
     * @param $projects
     */
    protected function addTasks($projects): void
    {
        $projects->each(function ($project) {
            factory(Task::class)->create(['project_id' => $project->id]);
        });
    }

}
