<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the owning activityable models.
     */
    public function activityable()
    {
        return $this->morphTo();
    }
}
