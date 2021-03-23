<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
     protected $table = 'trip';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
    protected $primaryKey = 'TRIP_ID';
    protected $fillable = ['TRIP_ID', 'TRIP_NAME', 'ROUTE_ID', 'FLEET_REG_ID', 'DRIVER_ID', 'ASSISTANT_1', 'FARE','PLANNED_DEP_DATE','ACTUAL_DEP_TIME','ACTUAL_ARR_DATE','ACTUAL_ARR_TIME', 'fromDate','toDate','Frequency','recurring','STATUS','OPERATOR_CODE','SEATMAP_LIB_CODE','max_seat', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'];



}
