<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Event extends Model
{
    use HasRoles;

    protected $guard_name = 'web';

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getBackgroundImageAttribute($value)
    {
        return ($value) ? Storage::disk('public')->url($value) : null;
    }

    public function getShowAttendanceCountAttribute($value)
    {
        return ($value) ? $value : null;
    }
}
