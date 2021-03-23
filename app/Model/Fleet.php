<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
        protected $table = 'fleet_registration';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
     protected $primaryKey = 'FLEET_ID'; 

     protected $fillable = ['FLEET_ID', 'FLEET_NAME', 'FLEET_TYPE_CODE', 'OPERATOR_CODE', 'MAKE', 'MODEL', 'ENGINE_NO', 'CHASIS_NO', 'YEAR_OF_MANUFACTURE', 'REG_NO', 'SEAT_CAPACITY', 'AC_AVAILABLE', 'ROUTE_ID', 'IS_ROUTE_ASSIGNED', 'COLOUR', 'HOME_TERMINAL', 'STATUS_CODE','amenities' ,'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'];


   public function operator()
    {
    
         return $this->belongsTo('App\Model\Operator','OPERATOR_CODE');

    }

   public function Route()
    {
    
         return $this->belongsTo('App\Model\Route','ROUTE_ID');

    }
  
}
