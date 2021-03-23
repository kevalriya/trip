<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
     protected $table = 'state';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
   
}
