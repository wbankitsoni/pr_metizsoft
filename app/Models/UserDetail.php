<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;

class UserDetail extends Model
{
	use HasFactory, Notifiable;


    protected $table = 'user_details';
    protected $fillable = [
        'id', 'FirstName','LastName','password','Email','Phone','Address','Country','State','City','ZipCode','Gender','Hobbies','Image',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // public function country() 
    // {
    //     return $this->hasMany('App\Models\Country', 'country', 'id')->with('countries');
    // }
    // public function product_Product_image() 
    // {
    //     return $this->hasMany('App\product_Product_image', 'product_id', 'id');
    // }

    public function country()
    {
     return $this->belongsTo('App\Models\Country');
    }
    //  public function country()
    // {
    //     return $this->hasMany('App\Models\Country','country_id', 'id')->with('countries');;
    // }
     public function state()
    {
        return $this->hasMany('App\Models\State','country_id', 'id')->with('states');;
    }
     public function city()
    {
        return $this->hasMany('App\Models\City','country_id', 'id')->with('cities');;
    }
    
    
    

}
