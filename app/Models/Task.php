<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $appends = ['path'];

    /**
     * @var array
     */
    protected $touches = ['project'];

    /**
     * The project of the class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the url path for the task as string
     *
     * @return string
     */
    public function getPathAttribute()
    {
        return '/projects/' . $this->project->id . '/tasks/' . $this->id;
    }
}
