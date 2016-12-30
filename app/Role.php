<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const STUDENT = 0;
    const INSTRUCTOR = 1;
    const EMPLOYEE = 2;
    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'role',
    ];
}
