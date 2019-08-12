<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function attendances()
    {
        return $this->hasMany('App\Attendances');
    }
}
