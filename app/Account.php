<?php

namespace App;

use Carbon\Carbon;

class Account extends BaseModel
{
    protected $guarded = [];

    public function getLastAccessedAttribute()
    {
        return Carbon::parse($this->attributes['last_accessed'])->format('d/m/Y H:i');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
