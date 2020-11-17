<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Get related Project
     */

    protected $guarded = [];

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }
}
