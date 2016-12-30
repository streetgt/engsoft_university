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

    /**
     * A Room belongs to many Schedules
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
