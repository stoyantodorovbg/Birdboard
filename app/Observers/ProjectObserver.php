<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Arr;

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
     * Handle the project "updating" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updating(Project $project)
    {
        $project->old = $project->getOriginal();
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
        return 'New Project - ' . $project->title . ' - has been created from ' . $project->owner->name . '.';
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

        $updated_properties = Arr::except($updated_properties, 'updated_at');

        $message = implode(', ', $updated_properties);

        $property = count($updated_properties) > 1 ? 'properties' : 'property';

        $message = $project->owner->name . ' updated the ' . $property . ' ' . $message . ' of the project ' . $project->title . '.';

        return $message;
    }
}
