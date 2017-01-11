<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App
 */
class Role extends Model
{
    /**
     * Constant that represent a Student
     */
    const STUDENT = 0;

    /**
     * Constant that represent a Instructor
     */
    const INSTRUCTOR = 1;

    /**
     * Constant that represent a Employee
     */
    const EMPLOYEE = 2;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role',
    ];
}
