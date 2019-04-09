<?php

namespace App\Models;

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
}
