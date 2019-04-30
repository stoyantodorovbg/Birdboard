<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $project->addActivity($this->messageCreated($project));
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        $project->addActivity($this->messageUpdated($project));
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function deleted(Project $project)
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
        return 'New Project - ' . $project->title . ' has been created from ' . $project->owner->name . '.';
    }

    /**
     * Create a message for the updated event
     *
     * @param Project $project
     * @return string
     */
    protected function messageUpdated(Project $project): string
    {
        $updated_properties = array_keys($project->getDirty());

        $message = implode(', ', $updated_properties);

        $property = count($updated_properties) > 1 ? 'properties' : 'property';

        $message = 'The project ' . $project->title . $property . ' ' . $message . ' has been updated from ' . $project->owner->name . '.';

        return $message;
    }
}
