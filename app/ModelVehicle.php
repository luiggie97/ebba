<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelVehicle extends Model
{
    protected $table = 'model_vehicles';

    protected $fillable=[
        'name',
    ];
}
