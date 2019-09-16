<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function getTanggalLahirAttribute($value)
    {
        return Carbon::create($value)->toDateString();
    }

    public function user()
    {
        return $this->belongsTo('App\User','nrp','username');
    }

    public function akk()
    {
        return $this->hasMany('App\Mahasiswa','pkk_id','nrp');
    }

    public function pkk()
    {
        return $this->belongsTo('App\Mahasiswa','pkk_id','nrp');
    }

    public function subDivisi()
    {
        return $this->belongsTo('App\SubDivisi');
    }
}
