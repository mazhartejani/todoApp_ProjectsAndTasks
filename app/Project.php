<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Get tasks for the current Project
     */

    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
