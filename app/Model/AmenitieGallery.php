<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AmenitieGallery extends Model
{
        protected $table = 'amenity_gallery';

     public $timestamps = false;
     // protected $primaryKey = 'AMENITY_GAL_CODE'; 

     protected $fillable = ['AMENITY_GAL_CODE', 'AMENITY_NAME', 'DESCRIPTION'];


}
