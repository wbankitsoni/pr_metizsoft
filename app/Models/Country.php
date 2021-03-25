<?php

namespace App\Models;
use App\Models\State;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     protected $table = 'countries';
    protected $fillable = [
        'id', 'c_name',
    ];
    public function state()
    {
        return $this->hasOne('App\Models\State');
    }
    public function userdetail(){
    return $this->hasmany('App\Models\UserDetail');
}
}
