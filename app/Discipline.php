<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Discipline
 * @package App
 */
class Discipline extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'discipline';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ects', 'course_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'discipline_course');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'discipline_course');
    }

    /**
     * A Discipline as many classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
