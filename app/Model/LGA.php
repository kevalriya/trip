<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
     protected $table = 'local_govt_area';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
  
}
