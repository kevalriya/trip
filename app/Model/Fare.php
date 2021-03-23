<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
     protected $table = 'fare';

  	public $timestamps = false;

    protected $primaryKey = 'FAREID';
    protected $fillable = ['FAREID', 'TRIP_ID', 'ROUTE_ID', 'STOPPOINTSTART', 'STOPPOINTEND', 'FAREADULT', 'FARECHILD', 'FARESPECIAL'];



}
