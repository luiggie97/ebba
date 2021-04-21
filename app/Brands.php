<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $fillable =[
        'name',
        'model_id',
    ];

    public function ModelVehicle()
    {
        return $this->belongsTo(ModelVehicle::class,'model_id','id');
    }
}
