<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Donor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Notifiable;

    protected $guarded = ['id'];

    protected $guard = ['donorlogin'];

    function rel_to_blood(){
        return $this->belongsTo(Blood::class, 'blood_id');
    }

    function rel_to_city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    function rel_to_subcity(){
        return $this->belongsTo(Upazila::class, 'subcity_id');
    }


public function routeNotificationForMail($notification)
    {
     
        return $this->email;
 
    }
    
}
