<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    public function attendances()
    {
        return $this->hasMany('App\Attendances');
    }
}
