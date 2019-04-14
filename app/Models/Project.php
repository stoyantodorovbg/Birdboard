<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
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
     * The url for this project
     *
     * @return string
     */
    public function getPathAttribute()
    {
        return '/projects/' . $this->id;
    }

    /**
     * The owner of the project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tasks of the project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Add a task to the project
     *
     * @param string $body
     */
    public function addTask(string $body)
    {
        $this->tasks()->create(['body' => $body]);
    }
}
