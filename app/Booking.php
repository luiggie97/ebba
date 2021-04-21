<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id',
        'rent_start',
        'rent_end',
        'user_id',
        'vehicle_id',
        'created_at',
        'updated_at'
    ];

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
