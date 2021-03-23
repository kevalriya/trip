<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
   
    protected $table = 'seat';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
     protected $primaryKey = 'SEAT_ID'; 
     protected $fillable = ['SEAT_ID', 'SEATMAP_LIB_CODE', 'SEAT_NAME', 'SEATTYPE','CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT' ];

 
}

