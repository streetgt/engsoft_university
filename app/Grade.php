<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grade
 * @package App
 */
class Grade extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'grade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'instructor_id',
        'discipline_id',
        'grade',
        'description',
        'date',
    ];


}
