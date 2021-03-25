<?php

namespace App\Models;
use App\Models\State;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'id', 'name','state_id',
    ];
  //   public function State
  // {
  //   return $this->belongsTo('App\Models\State');
  // }
   public function state()
    {
        return $this->belongsTo('App\Models\State','state_id', 'id');
    }
}
