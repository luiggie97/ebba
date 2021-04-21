<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable=[
        'brand_id',
        'model_vehicle_id',
        'photo',
        'plate',
        'type',
        'description',
        'year',
    ];
    public function Brand()
    {
        return $this->belongsTo(Brands::class,'brand_id','id');
    }
    public function ModelVehicle()
    {
        return $this->belongsTo(ModelVehicle::class,'model_vehicle_id','id');
    }
    public function Bookings()
    {
        return $this->hasMany(Booking::class,'vehicle_id','id')->with('User');
    }
}
