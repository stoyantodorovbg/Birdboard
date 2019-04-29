<?php

namespace Tests\Setup;

use App\User;
use App\Models\Task;
use App\Models\Project;

class ProjectFactory
{
    /**
     * @var int
     */
    protected $tasks_count = 0;

    /**
     * Set tasks count
     *
     * @param int $tasksCount
     * @return $this
     */
    public function withTasks(int $tasksCount) : ProjectFactory
    {
        $this->tasks_count = $tasksCount;

        return $this;
    }

    /**
     * Create a project with tasks
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data = []) : Project
    {
        $project = factory(Project::class)->create($data);

        factory(Task::class, $this->tasks_count)->create([
                'project_id' => $project->id,
            ]
        );

        return $project;
    }
}