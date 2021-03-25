<?php

namespace App\Models;
use App\Models\Country;
use App\Models\City;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
     protected $table = 'states';
    protected $fillable = [
        'id', 's_name','country_id',
    ];
   public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id', 'id');
    }
     public function city()
    {
        return $this->hasOne('App\Models\City');
    }
}
