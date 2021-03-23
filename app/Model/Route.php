<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //

    protected $table = 'route';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
     protected $primaryKey = 'ROUTE_ID'; 
     protected $fillable = ['ROUTE_ID', 'ROUTE_NAME', 'ORIGIN_CITY', 'DEST_CITY', 'OPERATOR_CODE', 'TOTAL_DISTANCE', 'ESTD_TRAVEL_TIME', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'];

   public function operator()
    {
    
         return $this->belongsTo('App\Model\Operator','OPERATOR_CODE');

    }

   public function OriginCITY()
    {
    return $this->belongsTo('App\Model\City','ORIGIN_CITY');
	}

   public function DestCITY()
    {
    return $this->belongsTo('App\Model\City','DEST_CITY');
	}

      public function routePoint()
    {
      
        return $this->hasMany('App\Model\Routepoint','ROUTE_ID');
    } 

    public function Fleet()
    {
      
        return $this->hasMany('App\Model\Fleet','ROUTE_ID');
    }
}
