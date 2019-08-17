<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    public function attendances()
    {
        return $this->hasMany('App\Attendances');
    }

    public function getBackgroundImageAttribute($value)
    {
        return Storage::disk('neo-s3')->url($value);
    }
}
