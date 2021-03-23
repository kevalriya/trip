<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Routepoint extends Model
{
       protected $table = 'route_stoppoint';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
    protected $primaryKey = 'ROUTE_STOPPOINT_ID'; 

  	 protected $fillable = ['ROUTE_STOPPOINT_ID', 'ROUTE_ID', 'CITY_CODE', 'ROUTE_STOPPOINT_TYPE', 'ROUTE_STOPPOINT_SEQNO', 'ARRIVAL_TIME', 'DEPARTURE_TIME','ADDITIONAL_INFO', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'];
	public function route()
	{
		 return $this->belongsTo('App\Model\Route','ROUTE_ID');
	}
}