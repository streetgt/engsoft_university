<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'instructor';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'hiredate',
        'vatnumber',
        'gender',
        'token',
    ];

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
