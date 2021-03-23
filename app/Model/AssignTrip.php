<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignTrip extends Model
{
       protected $table = 'trip_assign';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
    protected $primaryKey = 'TRIP_ASSIGN_ID';
       protected $fillable = [ 'TRIP_ASSIGN_ID', 'TRIP_ID', 'SEATS_MAXCOUNT', 'SEATS_SOLD', 'SEATS_LEFT', 'TOTAL_INCOME', 'PLANNED_DEP_DATE', 'PLANNED_DEP_TIME', 'PLANNED_ARR_TIME', 'PLANNED_ARR_DATE', 'ACTUAL_DEP_DATE', 'ACTUAL_DEP_TIME', 'ACTUAL_ARR_TIME', 'ACTUAL_ARR_DATE', 'BEGIN_ODOMETER', 'END_ODOMETER', 'TOTAL_FUEL', 'TOTAL_EXPENSE', 'ASSIGN_TIME', 'TRIP_COMMENT','scriptDate', 'CLOSED_BY_ID', 'SCHEDULED_FLAG', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'];


  


}
