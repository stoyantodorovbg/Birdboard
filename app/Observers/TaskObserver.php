<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->project->addActivity($this->messageCreated($task->project));
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        $task->project->addActivity($this->messageUpdated($task->project));
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Create a message for the created event
     *
     * @param Project $project
     * @return string
     */
    protected function messageCreated(Project $project): string
    {
        return $project->owner->name . ' created a new Task for the project ' . $project->title . '.';
    }

    /**
     * Create a message for the updated event
     *
     * @param Project $project
     * @return string
     */
    protected function messageUpdated(Project $project): string
    {
        return $project->owner->name . ' updated a Task for the project ' . $project->title . '.';
    }
}
