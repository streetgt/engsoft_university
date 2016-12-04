<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    /**
     * @var string
     */
    protected $table = 'discipline';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'discipline_course');
    }
}
