<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Arr;
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
     * @var array
     */
    public $old = [];

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

    /**
     * The activities for the project
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'activityable')->latest();
    }

    /**
     * The members of the project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members');
    }

    /**
     * Add an activity to the project
     *
     * @param string $message
     */
    public function addActivity(string $message): void
    {
        $changes = $this->getActivityChanges();

        $this->activities()->create([
            'user_id' => $this->owner_id,
            'action' => $message,
            'changes' => $changes,
        ]);
    }

    /**
     * Add an user to the project members
     *
     * @param User $user
     */
    public function invite(User $user)
    {
        $this->members()->attach($user);
    }

    /**
     * Get the changes for the this model
     *
     * @return array|null
     */
    protected function getActivityChanges()
    {
        return $this->old ? [
            'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
            'after' => Arr::except($this->getChanges(), 'updated_at'),
        ] : NULL;
    }
}
