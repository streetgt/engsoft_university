<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'student';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'ssn',
        'birthdate',
        'gender',
        'token',
    ];

    /**
     * A Student belongs to many courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course')
            ->withTimestamps();;
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    /**
     * A Student has-many grades
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
