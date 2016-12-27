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

    protected $fillable = [
        'id',
        'name',
        'ects',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'discipline_course');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course')
            ->withTimestamps();
    }
}
