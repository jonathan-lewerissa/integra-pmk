<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public function event()
    {
        return $this->hasMany('App\Event');
    }

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'nrp', 'nrp');
    }
}
