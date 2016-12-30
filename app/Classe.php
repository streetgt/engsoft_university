<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Classe extends Model
{
    /**
     * @var string
     */
    protected $table = 'class';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'discipline_id',
        'instructor_id',
    ];
}
