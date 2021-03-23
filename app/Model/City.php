<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
     protected $table = 'city';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
 	 protected $primaryKey = 'CITY_CODE'; // or null

    public $incrementing = false;

        protected $fillable = [
     'CITY_CODE', 'CITY_NAME', 'STATE_CODE', 'COUNTRY_ID', 'LATITUDE', 'LONGITUDE', 'CITY_PHOTO', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'
    ];

 	public function route()
    {
      
        return $this->hasOne('App\Model\Route','CITY_CODE');
    }
}


