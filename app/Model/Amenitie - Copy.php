<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Amenitie extends Model
{
        protected $table = 'amenities';

     public $timestamps = false;
     protected $primaryKey = 'AMENITY_ID'; 

     protected $fillable = ['AMENITY_ID', 'FLEET_ID', 'AMENITY_GAL_CODE '];


}
