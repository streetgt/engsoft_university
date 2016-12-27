<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * @var string
     */
    protected $table = 'grade';

    /**
     * @var array
     */
    protected $fillable = [
        'student_id',
        'course_id',
        'discipline_id',
        'grade',
        'description',
        'date',
    ];


}
