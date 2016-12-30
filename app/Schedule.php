<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * @var string
     */
    protected $table = 'schedule';

    /**
     * @var array
     */
    protected $fillable = [
        'room_id',
        'class_id',
        'day',
        'start_hour',
        'duration'
    ];

    /**
     * A Schedule has a room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    /**
     * A Schedule has a class
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classe()
    {
        return $this->hasOne(Classe::class, 'id', 'class_id');
    }
}
