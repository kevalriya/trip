<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
}
