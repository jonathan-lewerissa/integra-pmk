<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];

    public function event()
    {
        return $this->hasMany('App\Event');
    }
}
