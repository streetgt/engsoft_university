<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Course extends Model
{
    /**
     * @var string
     */
    protected $table = 'course';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'discipline_course');
    }
}
