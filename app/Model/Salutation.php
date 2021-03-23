<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Salutation extends Model
{
     protected $table = 'salutation_label';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
   
}
