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
    protected $fillable = ['name', 'surname', 'ssn', 'birthdate', 'gpa', 'gender'];
}
