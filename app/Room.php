<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * @var string
     */
    protected $table = 'room';

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'capacity',
    ];
}
