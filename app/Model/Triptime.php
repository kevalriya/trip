<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Triptime extends Model
{
       protected $table = 'trip_timing';

    const CREATED_AT = 'CREATE_DT';
    const UPDATED_AT = 'MOD_DT';
    protected $primaryKey = 'ROUTE_STOPPOINT_ID'; 

  	 protected $fillable = ['id', 'TRIP_ID', 'ROUTE_ID','CITY_CODE', 'ARRIVAL_TIME', 'DEPARTURE_TIME', 'CREATE_DT', 'MOD_DT'];

}